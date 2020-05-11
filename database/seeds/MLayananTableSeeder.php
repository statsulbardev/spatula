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
        m_layanan::create([
            'kode_layanan' => '2',
            'nama_layanan' => 'Konsultasi Pengguna Data'
        ]);
        m_layanan::create([
            'kode_layanan' => '3',
            'nama_layanan' => 'Perpustakaan Tercetak'
        ]);
        m_layanan::create([
            'kode_layanan' => '4',
            'nama_layanan' => 'Perpustakaan Digital'
        ]);
        m_layanan::create([
            'kode_layanan' => '5',
            'nama_layanan' => 'Penjualan Buku'
        ]);
        m_layanan::create([
            'kode_layanan' => '6',
            'nama_layanan' => 'Mikro/Peta Digital/Softcopy Publikasi'
        ]);
        m_layanan::create([
            'kode_layanan' => '7',
            'nama_layanan' => 'Website'
        ]);
        m_layanan::create([
            'kode_layanan' => '8',
            'nama_layanan' => 'Email'
        ]);
        m_layanan::create([
            'kode_layanan' => '9',
            'nama_layanan' => 'Chat Us'
        ]);
        m_layanan::create([
            'kode_layanan' => '10',
            'nama_layanan' => 'Whatsapp'
        ]);
    }
}
