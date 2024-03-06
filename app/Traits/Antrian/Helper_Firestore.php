<?php

namespace App\Traits\Antrian;

use App\Models\d_antrian_satker;
use App\Models\d_antrian_satker_config_view;
use App\Models\m_antrian_satker_layanan;
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
    
    private $sync_with_firebase = false;

    function setup_client_create() :FirestoreClient
    {
        return  new FirestoreClient([
            'projectId' => 'spatula-antrian',
        ]);
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
            ->whereDate('tanggal', Carbon::today())
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
                'is_active' => $item['is_active'],
                'antrian' => $item['antrian'],
            ];
        }
        $db_client->collection('antrian')->document($kode_satker)->set($data_dict);
    }

}