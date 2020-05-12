<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class d_penilaian extends Model
{
    protected $table = 'd_penilaian';

    protected $fillable = [
        'nama_konsumen',
        'kode_layanan',
        'rating_layanan',
        'email_konsumen',
        'no_wa_telepon',
        'kode_petugas',
        'rating_petugas',
        'kode_saran',
        'saran_pengaduan',
        'tanggal_notifikasi',
        'tanggal_kategorisasi',
        'tanggal_tl_pj_layanan',
        'text_pj_layanan',
        'tanggal_tl_pj_pengaduan',
        'text_pj_pengaduan',
        'selesai',
        'tanggal_selesai'
    ];

    protected $casts = [
        'kode_saran' => 'array'
    ];

    public function petugas()
    {
        return $this->belongsTo(m_pengguna::class, 'kode_petugas');
    }

    public function layanan()
    {
        return $this->belongsTo(m_layanan::class, 'kode_layanan');
    }

    public function saran()
    {
        return $this->belongsTo(m_saran::class, 'kode_saran');
    }
}
