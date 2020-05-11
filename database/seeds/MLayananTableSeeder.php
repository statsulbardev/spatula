<?php

use App\Models\m_layanan;
use Illuminate\Database\Seeder;

class MLayananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_layanan::create([
            'kode_layanan' => '1',
            'nama_layanan' => 'Konsultasi dan Rekomendasi Kegiatan Statistik'
        ]);
    }
}
