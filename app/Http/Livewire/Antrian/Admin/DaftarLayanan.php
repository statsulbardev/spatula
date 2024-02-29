<?php

namespace App\Http\Livewire\Antrian\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Exception;

use App\Models\m_antrian_satker_layanan;
use App\Http\Livewire\Antrian\Traits\Helper_Firestore;

class DaftarLayanan extends Component
{
    use Helper_Firestore;

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
        $data_to_render = $this->retrieveData();

        return view('livewire.antrian.daftar-layanan', [
            'data' => $data_to_render
        ])->layout('layouts.app');
    }

    public function changeValueActive($kode_satker, $kode_layanan, $kondisi_baru)
    {
        if(in_array($kondisi_baru, ['0', '1'])){
            DB::beginTransaction();
            try{  
                m_antrian_satker_layanan::where('kode_satker', $kode_satker)
                    ->where('kode_layanan', $kode_layanan)
                    ->update(['is_active' => $kondisi_baru]);
                $this->set_daftar_layanan($this->setup_client_create(), $kode_satker);
                DB::commit();
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                throw new Exception(500);
            }
           
        }
    }

    public function changeValueLoket($kode_satker, $kode_layanan, $kondisi_baru)
    {
        if(in_array($kondisi_baru, ['A', 'B','C', 'D','E', 'F','G', 'H','I', 'J','K', 'L','M', 'N','O', 'P',
            'Q', 'R','S', 'T','U', 'V','W', 'X','Y', 'X'])){
                DB::beginTransaction();
                try{  
                    m_antrian_satker_layanan::where('kode_satker', $kode_satker)
                        ->where('kode_layanan', $kode_layanan)
                        ->update(['loket' => $kondisi_baru]);
                    $this->set_daftar_layanan($this->setup_client_create(), $kode_satker);
                    DB::commit();
                }catch(Exception $ex){
                    DB::rollBack();
                    Log::error($ex);
                    throw new Exception(500);
                }
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
