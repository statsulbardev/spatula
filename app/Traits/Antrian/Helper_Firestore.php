<?php

namespace App\Traits\Antrian;

use App\Models\d_antrian_satker;
use App\Models\d_antrian_satker_config_view;
use App\Models\m_antrian_satker_layanan;
use App\Models\m_layanan;
use App\Models\m_satker;
use Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Log;

trait Helper_Firestore
{
    //antrian_{kode_satker}

    // {
    //     daftar_layanan : {
    //         {kode_layanan} : {....., }
    //     }
    //     konfigurasi : {
    //         {key : { index : value}}
    //     }
    //     antrian: {
    //         'tanggal_tanggal' : 'tanggal'
    //         'aktive': 'string with || seperate',
    //         'data': {
    //             'id' : {data}
    //         }
    //     }
    // }

    private $sync_with_firebase = true;

    function setup_client_create() :FirestoreClient
    {
        return  new FirestoreClient(json_decode( file_get_contents(base_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true));
    }

    function set_service_list_change(m_layanan $service, $type)
    {
        if( $type == 'ubah' ){
            $satker = m_satker::all();
            if($service->metode == 1){
                //online => offline
                foreach($satker as $item_sateker){
                    $item_m_layanan = new m_antrian_satker_layanan();
                    $item_m_layanan->kode_satker = $item_sateker->kode_satker;
                    $item_m_layanan->kode_layanan = $service->kode_layanan;
                    $item_m_layanan->is_active = '1';
                    $item_m_layanan->save();
                }
            }if($service->metode == 2){
                //offlime => online
                m_antrian_satker_layanan::where('kode_layanan', $service->kode_layanan)->delete();
            }

            foreach($satker as $item_sateker){
                $this->set_daftar_layanan($this->setup_client_create(), $item_sateker->kode_satker);
            }
        }else if($type == 'hapus'){
            m_antrian_satker_layanan::where('kode_layanan', $service->kode_layanan)->delete();
            $satker = m_satker::all();
            foreach($satker as $item_sateker){
                $this->set_daftar_layanan($this->setup_client_create(), $item_sateker->kode_satker);
            }
        }
    }

    function set_satker_service_list_change($unitId, $serviceId, $type)
    {
        $service = m_layanan::where('id', $serviceId )->first();

        if($service->metode == '1'){
            $unit = m_satker::where('id', $unitId )->first();
            $m_antrian_satker_layanan = m_antrian_satker_layanan::where('kode_satker', $unit->kode_satker)
                ->where('kode_layanan', $service->kode_layanan)
                ->first();

            if($type == 'tambah' && !$m_antrian_satker_layanan){
                $m_antrian_satker_layanan = new m_antrian_satker_layanan();
                $m_antrian_satker_layanan->kode_satker = $unit->kode_satker;
                $m_antrian_satker_layanan->kode_layanan = $service->kode_layanan;
                $m_antrian_satker_layanan->loket = 'A';
                $m_antrian_satker_layanan->is_active = 0;
                $m_antrian_satker_layanan->save();

                $this->set_daftar_layanan($this->setup_client_create(), $unit->kode_satker);
            }else if($type == 'hapus'){
                m_antrian_satker_layanan::where('kode_satker', $unit->kode_satker)
                    ->where('kode_layanan', $service->kode_layanan)
                    ->delete();

                $this->set_daftar_layanan($this->setup_client_create(), $unit->kode_satker);
            }
        }
    }

    function set_daftar_layanan(FirestoreClient $db_client, $kode_satker)
    {
        if(!$this->sync_with_firebase){
            return null;
        }
        $data_arr =  m_antrian_satker_layanan::with(['satker', 'layanan'])
            ->where('kode_satker', $kode_satker)
            ->get()
            ->toArray();
        $data_dict = [];
        foreach($data_arr as $item){
            $data_dict[$item['kode_satker'].'-'.$item['kode_layanan']] = $item;
        }
        $db_client->collection('layanan')->document($kode_satker)->set($data_dict);
    }

    function set_konfigurasi(FirestoreClient $db_client, $kode_satker)
    {
        if(!$this->sync_with_firebase){
            return null;
        }
        $data_arr =  d_antrian_satker_config_view::where('kode_satker', $kode_satker)
            ->orderby('config_key', 'asc')
            ->orderby('config_index', 'asc')
            ->get()
            ->toArray();
        $data_dict = [];
        foreach($data_arr as $item){
            if(!array_key_exists($item['config_key'], $data_dict)){
                $data_dict[$item['config_key']] = [];
            }
            $data_dict[$item['config_key']][$item['config_index']] = $item['config_value'];
        }
        $db_client->collection('konfigurasi')->document($kode_satker)->set($data_dict);
    }

    function set_antrian(FirestoreClient $db_client, $kode_satker)
    {
        if(!$this->sync_with_firebase){
            return null;
        }

        $data_arr =  d_antrian_satker::where('kode_satker', $kode_satker)
            ->whereDate('tanggal', Carbon::today()->format('Y-m-d'))
            ->get()
            ->toArray();
        $data_dict = [];

        foreach($data_arr as $item){
            $data_dict[$item['id']] =
            [
                'kode_satker' => $item['kode_satker'],
                'kode_layanan' => $item['kode_layanan'],
                'konsumen_nama' => $item['konsumen_nama'],
                'tanggal' => $item['tanggal'],
                'status' => $item['status'],
                'antrian' => $item['antrian'],
                'antrian_counter' => $item['antrian_pemanggil_counter'],
            ];
        }
        $db_client->collection('antrian')->document($kode_satker)->set($data_dict);
    }

}
