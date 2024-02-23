<?php

namespace Database\Seeders;

use App\Models\m_antrian_satker_layanan;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert_m_antrian_satker_layanan();
        $this->antrian_add_role();
        $this->change_pass_all();
    }

    private function insert_m_antrian_satker_layanan()
    {
        $all_satker = m_satker::orderby('kode_satker', 'asc')->get();
        $layanan_yang_diinsert = m_layanan::whereIn('kode_layanan', ['2','3','4','5'])
            ->orderby('id', 'asc')
            ->get();
        foreach($all_satker as $item_satker){
            foreach($layanan_yang_diinsert as $item_layanan){
                $item_m_layanan = new m_antrian_satker_layanan();
                $item_m_layanan->kode_satker = $item_satker->kode_satker;
                $item_m_layanan->kode_layanan = $item_layanan->kode_layanan;
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
}
