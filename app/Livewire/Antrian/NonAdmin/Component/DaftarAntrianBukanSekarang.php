<?php

namespace App\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Exception;

class DaftarAntrianBukanSekarang extends Component
{
    use WithPagination;

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
            ['data' => $this->retrieveData(), 'master_key_value' => $master_key_value]);
    }

    private function retrieveData() : Paginator
    {
         return d_antrian_satker::with(['satker', 'layanan'])
            ->where('konsumen_email', session('konsumen_email'))
            ->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'))
            ->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'))
            ->paginate($this->numberOfPagination);
        
    }

}
