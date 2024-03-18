<?php

namespace App\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Exception;
use Carbon\Carbon;

class DaftarAntrianBukanSekarang extends Component
{
    use WithPagination;
    public d_antrian_satker $antrian_tobe_delete;

    public int $numberOfPagination = 20;
    public $selectedMonth;
    public $selectedYear;

    /** @computed property : months */
    public function getMonthsProperty()
    {
        return [
            ['1' => 'Januari'],
            ['2' => 'Februari'],
            ['3' => 'Maret'],
            ['4' => 'April'],
            ['5' => 'Mei'],
            ['6' => 'Juni'],
            ['7' => 'Juli'],
            ['8' => 'Agustus'],
            ['9' => 'September'],
            ['10' => 'Oktober'],
            ['11' => 'November'],
            ['12' => 'Desember']
        ];
    }

    /** @computed property : years */
    public function getYearsProperty()
    {
        $tahun_arr = [];
        for($i=2024; $i <= date('Y'); $i++){
            array_push( $tahun_arr, $i);
        }
        return $tahun_arr;
    }

    public function resetData()
    {
        $this->reset();
        $this->dispatch('daftar-antrian-bukan-sekarang-reset-filter');
    }
    
    public function render()
    {
        $master_antrian_satker = m_antrian_satker_layanan::all();
        $master_key_value = [];
        foreach($master_antrian_satker as $item){
            $master_key_value[$item->kode_satker.'--'.$item->kode_layanan] = $item->loket;
        }

        return view('livewire.antrian.non-admin.component.daftar_antrian_bukan_sekarang', 
            ['data' => $this->retrieveData(), 'master_key_value' => $master_key_value, 'today_tanggal' => Carbon::today()->format('Y-m-d')]);
    }

    private function retrieveData() : Paginator
    {
        $d_antrian_satker_query = d_antrian_satker::query();
        $d_antrian_satker_query->with(['satker', 'layanan'])
            ->where('konsumen_email', session('konsumen_email'))
            ->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'))
            ->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'));

        if($this->selectedYear){
            $d_antrian_satker_query->whereYear('tanggal', $this->selectedYear);
        }
        if($this->selectedMonth){
            $d_antrian_satker_query->whereMonth('tanggal', $this->selectedMonth);
        }
        $d_antrian_satker_query->orderByRaw('CASE WHEN tanggal = "'.Carbon::today()->format('Y-m-d').'" THEN 0 ELSE 1 END ASC');
        $d_antrian_satker_query->orderBy('tanggal', 'desc');
        $d_antrian_satker_query->orderBy('antrian', 'asc');

        // Log::info($d_antrian_satker_query->toSql());

        return $d_antrian_satker_query->paginate($this->numberOfPagination);
        
    }

    public function deleteItem(d_antrian_satker $antrian_tobe_delete_)
    {
        $this->antrian_tobe_delete = $antrian_tobe_delete_;
    }

    public function confirmDeleteItem()
    {
        try
        {
            $this->antrian_tobe_delete->delete();
            $this->dispatch('notification', message: "Informasi antrian telah dihapus.");
        }catch (Exception $error) 
        {
            $this->dispatch('notification', message: "Informasi antrian gagal dihapus.");
        }
    }

}
