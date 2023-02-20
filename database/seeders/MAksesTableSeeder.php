<?php

namespace Database\Seeders;

use App\Models\m_akses;
use Illuminate\Database\Seeder;

class MAksesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_akses::create([
            'kode_akses' => 1,
            'nama_akses' => 'Superadmin'
        ]);
        m_akses::create([
            'kode_akses' => 2,
            'nama_akses' => 'Admin'
        ]);
        m_akses::create([
            'kode_akses' => 3,
            'nama_akses' => 'Pimpinan'
        ]);
        m_akses::create([
            'kode_akses' => 4,
            'nama_akses' => 'PJ Layanan'
        ]);
        m_akses::create([
            'kode_akses' => 5,
            'nama_akses' => 'PJ Pengaduan'
        ]);
        m_akses::create([
            'kode_akses' => 6,
            'nama_akses' => 'Tim ZI Area Pengawasan'
        ]);
        m_akses::create([
            'kode_akses' => 7,
            'nama_akses' => 'Petugas/Operator'
        ]);
    }
}
