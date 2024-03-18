<?php

namespace App\Livewire\Antrian\Admin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use App\Traits\Antrian\Helper_Firestore;
use Carbon\Carbon;
use Exception;
use Illuminate\View\View;
use Livewire\Component;
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


    public function reset_active($loket)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{ 
                $arr_kode_layanan = m_antrian_satker_layanan::where('loket', $loket)
                    ->where('is_active', '1')
                    ->get()
                    ->pluck('kode_layanan')
                    ->toArray();

               d_antrian_satker::whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                    ->whereIn('kode_layanan', $arr_kode_layanan)
                    ->where('kode_satker', $user_unit_code)
                    ->update([
                        'status' => 0
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

    public function mulai_dan_next($loket)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{ 
                $arr_kode_layanan = m_antrian_satker_layanan::where('loket', $loket)
                    ->where('is_active', '1')
                    ->get()
                    ->pluck('kode_layanan')
                    ->toArray();

                $latest = d_antrian_satker::whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                    ->whereIn('kode_layanan', $arr_kode_layanan)
                    ->where('kode_satker', $user_unit_code)
                    ->whereIn('status', ['0', '1'])
                    ->orderByRaw('CASE WHEN status = "2" THEN 1 ELSE 0 END ASC')
                    ->orderBy('antrian')
                    ->first();
                if($latest){
                    $latest->status = '1';
                    $latest->antrian_pemanggil_counter = '1';
                    $latest->save();
                }
               
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

    public function selesaikan_dan_next($id, $loket)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{ 
                d_antrian_satker::whereIn('status', ['1'])
                    ->where('id', $id)
                    ->where('kode_satker', $user_unit_code)
                    ->where('tanggal', Carbon::today()->format('Y-m-d'))
                    ->update([
                        'status' => 2,
                        'antrian_pemanggil_counter' => '0'
                    ]);

                $arr_kode_layanan = m_antrian_satker_layanan::where('loket', $loket)
                    ->where('is_active', '1')
                    ->get()
                    ->pluck('kode_layanan')
                    ->toArray();

                $new_active = d_antrian_satker::whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                    ->whereIn('kode_layanan', $arr_kode_layanan)
                    ->where('kode_satker', $user_unit_code)
                    ->whereIn('status', ['0', '1'])
                    ->orderByRaw('CASE WHEN status = "2" THEN 1 ELSE 0 END ASC')
                    ->orderBy('antrian')
                    ->first();
                if($new_active){
                    $new_active->status = '1';
                    $new_active->antrian_pemanggil_counter = '1';
                    $new_active->save();
                }
               
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

    public function belum_selesaikan_dan_next($id, $loket)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{ 
                $arr_kode_layanan = m_antrian_satker_layanan::where('loket', $loket)
                    ->where('is_active', '1')
                    ->get()
                    ->pluck('kode_layanan')
                    ->toArray();
                
                $yang_dilangkahi = d_antrian_satker::whereIn('status', ['1'])
                    ->where('id', $id)
                    ->where('kode_satker', $user_unit_code)
                    ->where('tanggal', Carbon::today()->format('Y-m-d'))
                    ->first();

                if($yang_dilangkahi){
                    $latest_antrian_query = d_antrian_satker::query();
                    $latest_antrian_query->where('tanggal', $yang_dilangkahi->tanggal);
                    $latest_antrian_query->where('periode', $yang_dilangkahi->periode);
                    $latest_antrian_query->whereIn('kode_layanan', $arr_kode_layanan);
                    $latest_antrian_query->orderby('antrian', 'desc');
                    $latest_antrian = $latest_antrian_query->first();
            
                    $latest_number = 0;
                    
                    if($latest_antrian){
                        $latest_number = intval(substr($latest_antrian->antrian,1));
                    }
                    $latest_number  += 1;
                    $antrian_baru = str_pad($latest_number, 2, "0", STR_PAD_LEFT);
            
                    $latest_antrian_internal_query = d_antrian_satker::query();
                    $latest_antrian_internal_query->where('tanggal', $yang_dilangkahi->tanggal);
                    $latest_antrian_internal_query->orderby('antrian_internal', 'desc');
                    $latest_antrian_internal = $latest_antrian_internal_query->first();
                    $antrian_internal_baru = 0;
                    if($latest_antrian_internal){
                        $antrian_internal_baru = intval($latest_antrian_internal->antrian_internal);
                    }
                    $antrian_internal_baru +=1;

                    $yang_dilangkahi->antrian = $yang_dilangkahi->periode.$antrian_baru;
                    $yang_dilangkahi->antrian_internal = $antrian_internal_baru;
                    $yang_dilangkahi->antrian_pemanggil_counter = '0';
                    $yang_dilangkahi->status = 0;
                    $yang_dilangkahi->save();
                }

                    
                $new_active = d_antrian_satker::whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                    ->whereIn('kode_layanan', $arr_kode_layanan)
                    ->where('kode_satker', $user_unit_code)
                    ->whereIn('status', ['0', '1'])
                    ->orderByRaw('CASE WHEN status = "2" THEN 1 ELSE 0 END ASC')
                    ->orderBy('antrian')
                    ->first();
                if($new_active){
                    $new_active->status = '1';
                    $new_active->antrian_pemanggil_counter = '1';
                    $new_active->save();
                }
               
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

    public function call_the_active($id)
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;
        if($user_unit_code){
            DB::beginTransaction();
            try{                 
                $yang_active = d_antrian_satker::whereIn('status', ['1'])
                    ->where('id', $id)
                    ->where('kode_satker', $user_unit_code)
                    ->where('tanggal', Carbon::today()->format('Y-m-d'))
                    ->first();

                $antrian_counter =  intval( $yang_active->antrian_pemanggil_counter  ) + 1;

                $yang_active->antrian_pemanggil_counter =  $antrian_counter;
                $yang_active->save();

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
            $data = d_antrian_satker::with('layanan')
                ->whereDate('tanggal',  Carbon::today()->format('Y-m-d'))
                ->whereIn('kode_layanan', $kode_layanan_active)
                ->where('kode_satker', $user_unit_code)
                ->orderByRaw('CASE WHEN status = "2" THEN 1 ELSE 0 END ASC')
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
