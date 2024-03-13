<?php

namespace App\Livewire\Antrian\Admin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use App\Traits\Antrian\Helper_Firestore;
use Carbon\Carbon;
use Exception;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Pemanggil extends Component
{
    use Helper_Firestore;

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

    public function selesaikan($id)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            d_antrian_satker::whereIn('status', ['0'])
                ->where('id', $id)
                ->where('kode_satker', $user_unit_code)
                ->where('tanggal', Carbon::today()->format('Y-m-d'))
                ->update([
                    'status' => 2
                ]);
        }
       
    }

    public function selesaikan_dan_next($id)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{  
                d_antrian_satker::whereIn('status', ['0'])
                    ->where('id', $id)
                    ->where('kode_satker', $user_unit_code)
                    ->where('tanggal', Carbon::today()->format('Y-m-d'))
                    ->update([
                        'status' => 2
                    ]);
                $this->set_antrian($this->setup_client_create(), $user_unit_code);
                DB::commit();
                $this->dispatch('notification', message: 'Berhasil menyimpan data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Gagal menyimpan data.');
            }
        }
    }

    public function rearrange()
    {   
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{  
                d_antrian_satker::rearrange($user_unit_code);
                $this->set_antrian($this->setup_client_create(), $user_unit_code);
                DB::commit();
                $this->dispatch('notification', message: 'Berhasil menyimpan data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Gagal menyimpan data.');
            }
        }
    }

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
