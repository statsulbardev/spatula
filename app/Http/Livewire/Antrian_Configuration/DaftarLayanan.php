<?php

namespace App\Http\Livewire\Antrian_Configuration;

use App\Models\m_antrian_satker_layanan;
use App\Models\m_pengguna;
use App\Traits\HasModelProcess;
use Laravel\Scout\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarLayanan extends Component
{
    use HasModelProcess;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('antrian-daftar-layanan'),
            'label' => 'Daftar Layanan Antrian'
        ];
    }

    public function render() : View
    {
        return view('livewire.antrian.daftar-layanan', [
            'data' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function changeValueActive($kode_satker, $kode_layanan, $kondisi_baru)
    {
        if(in_array($kondisi_baru, ['0', '1'])){
            m_antrian_satker_layanan::where('kode_satker', $kode_satker)
                ->where('kode_layanan', $kode_layanan)
                ->update(['is_active' => $kondisi_baru]);
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
