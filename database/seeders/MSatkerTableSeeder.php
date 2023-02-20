<?php

namespace Database\Seeders;

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
            'nama'        => 'Prov. Sulawesi Barat',
            'level'       => '1'
        ]);
        m_satker::create([
            'kode_satker' => '7601',
            'nama'        => 'Kab. Majene',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7602',
            'nama'        => 'Kab. Polewali Mandar',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7603',
            'nama'        => 'Kab. Mamasa',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7604',
            'nama'        => 'Kab. Mamuju',
            'level'       => '2'
        ]);
        m_satker::create([
            'kode_satker' => '7605',
            'nama'        => 'Kab. Pasangkayu',
            'level'       => '2'
        ]);
    }
}
