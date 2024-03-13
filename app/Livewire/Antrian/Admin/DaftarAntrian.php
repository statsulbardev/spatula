<?php

namespace App\Livewire\Antrian\Admin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class DaftarAntrian extends Component
{

    public $tanggal_filter; 

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('antrian-daftar'),
            'label' => 'Daftar Antrian'
        ];
    }

    // public function mount()
    // {
    //     m_a
    // }

    public function render() : View
    {
        $master_antrian_satker = m_antrian_satker_layanan::all();
        $master_key_value = [];
        foreach($master_antrian_satker as $item){
            $master_key_value[$item->kode_satker.'--'.$item->kode_layanan] = $item->loket;
        }

        $data_to_render = [];
        if($this->tanggal_filter){
            $data_to_render = d_antrian_satker::with(['satker', 'layanan'])
                ->where('tanggal', $this->tanggal_filter)
                ->where('kode_satker', Auth::user()->kode_satker_id)
                ->orderby('antrian', 'asc')
                ->get();
        }

        return view('livewire.antrian.admin.daftar-antrian', [
            'data' => $data_to_render, 'master_key_value' => $master_key_value
        ])->layout('layouts.app');
    }

   
}
