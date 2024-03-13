<?php

namespace App\Livewire\Antrian\Admin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Pemanggil extends Component
{

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('antrian-caller'),
            'label' => 'Pemanggil'
        ];
    }

    // public function mount()
    // {
    //     m_a
    // }

    public function render() : View
    {
        $show_data = [];
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            session(['kode_satker_active' => $user_unit_code]);
            $antrian_satker_layanan = m_antrian_satker_layanan::with('layanan')
                ->where('kode_satker', $user_unit_code)
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
            $data = d_antrian_satker::whereDate('tanggal',  '2024-03-14')
                ->whereIn('kode_layanan', $kode_layanan_active)
                ->where('kode_satker', $user_unit_code)
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

        return view('livewire.antrian.admin.pemanggil', [
            'show_data' => $show_data
        ])->layout('layouts.app');
    }
}
