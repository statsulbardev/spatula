<?php

use App\Models\d_penilaian;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DPenilaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        d_penilaian::create([
            'nama_konsumen' => 'Nagib Amir',
            'kode_layanan' => 1,
            'rating_layanan' => '4',
            'email_konsumen' => 'nagib@mail.com',
            'no_wa_telepon' => '081322356754',
            'kode_petugas' => 2,
            'rating_petugas' => '3',
            'kode_saran' => [1, 3],
            'saran_pengaduan' => 'lorem ipsum',
            'tanggal_notifikasi' => Carbon::now(),
            'tanggal_kategorisasi' => Carbon::now(),
            'tanggal_tl_pj_layanan' => Carbon::now(),
            'text_pj_layanan' => 'lorem ipsum',
            'tanggal_tl_pj_pengaduan' => Carbon::now(),
            'text_pj_pengaduan' => 'lorem ipsum',
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        d_penilaian::create([
            'nama_konsumen' => 'Chelsea Islan',
            'kode_layanan' => 1,
            'rating_layanan' => '4',
            'email_konsumen' => 'chelsea@mail.com',
            'no_wa_telepon' => '081322356753',
            'kode_petugas' => 2,
            'rating_petugas' => '3',
            'kode_saran' => [2],
            'saran_pengaduan' => 'lorem ipsum',
            'tanggal_notifikasi' => Carbon::now(),
            'tanggal_kategorisasi' => Carbon::now(),
            'tanggal_tl_pj_layanan' => Carbon::now(),
            'text_pj_layanan' => 'lorem ipsum',
            'tanggal_tl_pj_pengaduan' => Carbon::now(),
            'text_pj_pengaduan' => 'lorem ipsum',
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        d_penilaian::create([
            'nama_konsumen' => 'Uchek',
            'kode_layanan' => 1,
            'rating_layanan' => '3',
            'selesai' => 0,
        ]);
    }
}
