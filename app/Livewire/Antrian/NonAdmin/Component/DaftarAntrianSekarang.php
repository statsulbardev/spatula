<?php

namespace App\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\View\View;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use App\Models\m_satker;
use App\Traits\HasRenderOption;

class DaftarAntrianSekarang extends Component
{
    use HasRenderOption;
    
    public $kode_satker;
    
    public function mount()
    {
        if(session('kode_satker_active', null))
        {
            $this->kode_satker = session('kode_satker_active', null);
        }
        if(!$this->kode_satker)
        {
            $unit_tanggal = d_antrian_satker::whereDate('tanggal',"=", Carbon::today()->format('Y-m-d'))->first();
            if($unit_tanggal)
            {
                $this->kode_satker = $unit_tanggal->kode_satker;
            }
        }
    }

    public function getUnitsProperty(): string
    {
        return
            $this->renderOption(
                m_satker::get(['kode_satker', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => $item->kode_satker,
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );
    }

    public function render() : View
    {
        $show_data = [];
        if($this->kode_satker){
            session(['kode_satker_active' => $this->kode_satker]);
            $antrian_satker_layanan = m_antrian_satker_layanan::with('layanan')
                ->where('kode_satker', $this->kode_satker)
                ->where('is_active', '1')
                ->orderby('loket')
                ->get();

            $loket_key_index = [];
            $layanan_loket = [];

            foreach($antrian_satker_layanan as $item_layanan)
            {
                $layanan_loket[$item_layanan->kode_layanan] = $item_layanan->loket;
                if(!array_key_exists($item_layanan->loket, $loket_key_index)){
                    $loket_key_index[$item_layanan->loket] = count($show_data);
                    array_push($show_data, ['loket' => $item_layanan->loket, 'layanan' => [], 'active' => null, 'antrian_ku' => []]);
                }
                array_push($show_data[$loket_key_index[$item_layanan->loket]]['layanan']
                    , $item_layanan->layanan->nama_layanan);
            }

            $kode_layanan_active = collect($antrian_satker_layanan)->pluck('kode_layanan');

            $data = d_antrian_satker::whereDate('tanggal', Carbon::today()->format('Y-m-d'))
                ->where('kode_satker', $this->kode_satker)
                ->whereIn('kode_layanan', $kode_layanan_active)
                ->where(function ($query){
                    $query->orWhere('status', 1);
                    $query->orWhere(function ($query1){
                        $query1->where('konsumen_email', session('konsumen_email'));
                        $query1->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'));
                        $query1->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'));
                    });
                })
                ->orderBy('antrian')
                ->get();

            foreach($data as $item)
            {
                if($item->status == 1){
                    $show_data[$loket_key_index[$layanan_loket[$item->kode_layanan]]]['active'] = $item;
                }
                if($item->konsumen_email == session('konsumen_email') 
                    && $item->konsumen_no_wa_telepon == session('konsumen_no_wa_telepon') 
                    && $item->konsumen_tahun_lahir == session('konsumen_tahun_lahir'))
                {
                    array_push($show_data[$loket_key_index[$layanan_loket[$item->kode_layanan]]]['antrian_ku']
                        , $item);
                } 
            }
        }
       
        return view('livewire.antrian.non-admin.component.daftar_antrian_sekarang', ['show_data' => $show_data]);
    }

}
