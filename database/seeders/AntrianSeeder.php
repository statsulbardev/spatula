<?php

namespace Database\Seeders;

use App\Models\m_antrian_satker_layanan;
use App\Models\m_layanan;
use App\Models\m_satker;
use Illuminate\Database\Seeder;

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
    }

    private function insert_m_antrian_satker_layanan()
    {
        $all_satker = m_satker::orderby('kode_satker', 'asc')->get();
        $layanan_yang_diinsert = m_layanan::whereIn('id', ['2','3','4','5'])
            ->orderby('id', 'asc')
            ->get();
        foreach($all_satker as $item_satker){
            foreach($layanan_yang_diinsert as $item_layanan){
                $item_m_layanan = new m_antrian_satker_layanan();
                $item_m_layanan->id_satker = $item_satker->id;
                $item_m_layanan->id_layanan = $item_layanan->id;
                $item_m_layanan->save();
            }
        }
    }
}
