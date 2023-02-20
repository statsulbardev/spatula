<?php

namespace Database\Seeders;

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
            'nama_layanan' => 'Konsultasi dan Rekomendasi Kegiatan Statistik',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '2',
            'nama_layanan' => 'Konsultasi Pengguna Data',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '3',
            'nama_layanan' => 'Perpustakaan Tercetak',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '4',
            'nama_layanan' => 'Perpustakaan Digital',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '5',
            'nama_layanan' => 'Penjualan Buku',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '6',
            'nama_layanan' => 'Mikro/Peta Digital/Softcopy Publikasi',
            'kode_form'    => '1',
        ]);
        m_layanan::create([
            'kode_layanan' => '7',
            'nama_layanan' => 'Website',
            'kode_form'    => '2',
        ]);
        m_layanan::create([
            'kode_layanan' => '8',
            'nama_layanan' => 'Email',
            'kode_form'    => '2',
        ]);
        m_layanan::create([
            'kode_layanan' => '9',
            'nama_layanan' => 'Chat Us',
            'kode_form'    => '2',
        ]);
        m_layanan::create([
            'kode_layanan' => '10',
            'nama_layanan' => 'Whatsapp',
            'kode_form'    => '2',
        ]);
    }
}
