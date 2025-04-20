<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\NonAdmin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use App\Models\m_satker;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Traits\HasRenderOption;
use Livewire\Attributes\Computed;

class
DashboardAntrian extends Component
{
    use HasRenderOption;

    public $kode_satker;

    #[Computed]
    public function units(): string
    {
        $kode_satker = m_antrian_satker_layanan::where('is_active', '1')->select('kode_satker')->distinct()->get()->pluck(['kode_satker']);
        return
            $this->renderOption(
                m_satker::whereIn('kode_satker', $kode_satker)
                    ->get(['kode_satker', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => $item->kode_satker,
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );
    }

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

    #[Title('Dashboard Antrian')]
    public function render(): View
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
                    array_push($show_data, [
                        'loket' => $item_layanan->loket,
                        'layanan' => [],
                        'active' => null,
                        'daftar' => []
                    ]);
                }
                array_push($show_data[$loket_key_index[$item_layanan->loket]]['layanan']
                    , $item_layanan->layanan->nama_layanan);
            }

            $kode_layanan_active = collect($antrian_satker_layanan)->pluck('kode_layanan');

            // Carbon::today()->format('Y-m-d')
            $data = d_antrian_satker::whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                ->whereIn('kode_layanan', $kode_layanan_active)
                ->where('kode_satker', $this->kode_satker)
                ->whereIn('status', ['0', '1'])
                ->orderBy('antrian')
                ->get();

            foreach($data as $item)
            {
                if($item->status == 1){
                    $show_data[$loket_key_index[$layanan_loket[$item->kode_layanan]]]['active'] = $item;
                }
                array_push($show_data[$loket_key_index[$layanan_loket[$item->kode_layanan]]]['daftar'], $item);
            }
        }

        return view('livewire.antrian.non-admin.dashboard', ['show_data' => $show_data])
            ->layout('components.layouts.antrian-dashboard');
    }
}
