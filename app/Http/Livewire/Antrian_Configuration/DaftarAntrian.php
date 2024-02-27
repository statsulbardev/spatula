<?php

namespace App\Http\Livewire\Antrian_Configuration;

use App\Models\m_antrian_satker_layanan;
use App\Traits\HasModelProcess;
use Illuminate\View\View;
use Livewire\Component;

class DaftarAntrian extends Component
{
    use HasModelProcess;

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
        $data_to_render = $this->retrieveData();

        return view('livewire.antrian.daftar-antrian', [
            'data' => $data_to_render
        ])->layout('layouts.app');
    }

    public function changeValueActive($kode_satker, $kode_layanan, $kondisi_baru)
    {
        if(in_array($kondisi_baru, ['0', '1'])){
            m_antrian_satker_layanan::where('kode_satker', $kode_satker)
                ->where('kode_layanan', $kode_layanan)
                ->update(['is_active' => $kondisi_baru]);
            $dict_loket[$kode_satker.'--'.$kode_layanan] = $kondisi_baru;
        }
    }

    public function changeValueLoket($kode_satker, $kode_layanan, $kondisi_baru)
    {
        if(in_array($kondisi_baru, ['A', 'B','C', 'D','E', 'F','G', 'H','I', 'J','K', 'L','M', 'N','O', 'P',
            'Q', 'R','S', 'T','U', 'V','W', 'X','Y', 'X'])){
                m_antrian_satker_layanan::where('kode_satker', $kode_satker)
                    ->where('kode_layanan', $kode_layanan)
                    ->update(['loket' => $kondisi_baru]);
            $dict_is_active[$kode_satker.'--'.$kode_layanan] = $kondisi_baru;
        }
    }

    public function confirmUncheckItem()
    {
        $result = $this->delete($this->pengguna);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }

    private function retrieveData()
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;

        return m_antrian_satker_layanan::with(['satker', 'layanan'])
                ->where('kode_satker', $user_unit_code)
                ->get();
    }
}
