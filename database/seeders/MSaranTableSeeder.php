<?php

namespace Database\Seeders;

use App\Models\m_saran;
use Illuminate\Database\Seeder;

class MSaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_saran::create([
            'kode_saran' => '1',
            'nama_saran' => 'Saran'
        ]);
        m_saran::create([
            'kode_saran' => '2',
            'nama_saran' => 'Pengaduan'
        ]);
        m_saran::create([
            'kode_saran' => '3',
            'nama_saran' => 'Kritik'
        ]);
        m_saran::create([
            'kode_saran' => '4',
            'nama_saran' => 'Apresiasi'
        ]);
        m_saran::create([
            'kode_saran' => '9',
            'nama_saran' => 'Lainnya'
        ]);
    }
}
