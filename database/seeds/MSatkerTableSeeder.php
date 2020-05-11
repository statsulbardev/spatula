<?php

use App\Models\m_satker;
use Illuminate\Database\Seeder;

class MSatkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_satker::create([
            'kode_satker' => '7600',
            'nama'        => 'Provinsi Sulawesi Barat',
            'level'       => '1'
        ]);
        m_satker::create([
            'kode_satker' => '7601',
            'nama'        => 'Kabupaten Majene',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7602',
            'nama'        => 'Kabupaten Polewali Mandar',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7603',
            'nama'        => 'Kabupaten Mamasa',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7604',
            'nama'        => 'Kabupaten Mamuju',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7605',
            'nama'        => 'Kabupaten Pasangkayu',
            'level'       => '2'
        ]);
    }
}
