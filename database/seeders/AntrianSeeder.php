<?php

namespace Database\Seeders;

use App\Models\m_antrian_satker_layanan;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\Antrian\Helper_Firestore;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AntrianSeeder extends Seeder
{
    use Helper_Firestore;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert_m_antrian_satker_layanan();
        // $this->antrian_add_role();
        // $this->change_pass_all();
        $this->init_firebase();
    }

    private function insert_m_antrian_satker_layanan()
    {
        $layanan_offline = m_layanan::where('metode', 1)
            ->orderby('id', 'asc')
            ->get();

        $layanan_id = [];
        $dict_layanan = [];
        foreach($layanan_offline as $item){
            array_push($layanan_id, $item->id);
            $dict_layanan[$item->id] = $item;
        }

        $satker = m_satker::all();
        $dict_satkr = [];
        foreach($satker as $itm){
            $dict_satkr[$itm->id] = $itm;
        }

        $data = DB::table('m_satker_layanan')->whereIn('m_layanan_id', $layanan_id)->get();

        $unique_id_arr = [];
        foreach($data as $item_layanan){
            $item_unique_id = $dict_satkr[$item_layanan->m_satker_id]->kode_satker.'-'.$item_layanan->m_layanan_id;
            if(!in_array($item_unique_id, $unique_id_arr)){
                array_push($unique_id_arr, $item_unique_id);
                Log::alert($item_unique_id);
                $item_m_layanan = new m_antrian_satker_layanan();
                $item_m_layanan->kode_satker = $dict_satkr[$item_layanan->m_satker_id]->kode_satker;
                $item_m_layanan->kode_layanan = $dict_layanan[$item_layanan->m_layanan_id]->kode_layanan;
                $item_m_layanan->is_active = '1';
                $item_m_layanan->save();
            }
        }
    }

    private function antrian_add_role()
    {
        $data = [
            'pj-antrian',
            'operator-antrian',
        ];

        for ($i = 0; $i < count($data); $i++) {
            Role::create(['name' => $data[$i]]);
        }
    }

    private function change_pass_all(){
        $all_user = m_pengguna::all();
        foreach($all_user as $item_user){
            $new_pass_hash = Hash::make('secret');
            $item_user->password = $new_pass_hash;
            $item_user->save();
        }
    }
    private function init_firebase()
    {
        $db_client = $this->setup_client_create();
        $m_satker_arr = m_satker::all();
        foreach($m_satker_arr as $item){
            $this->set_daftar_layanan($db_client, $item->kode_satker);
            $this->set_konfigurasi($db_client, $item->kode_satker);
            $this->set_antrian($db_client, $item->kode_satker);
        }
    }
}
