<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class d_penilaian extends Model
{
    protected $table = 'd_penilaian';

    protected $fillable = [
        'nama_konsumen',
        'email_konsumen',
        'no_wa_telepon',
        'kode_petugas',
        'rating_petugas',
        'kode_layanan',
        'rating_layanan',
        'kode_saran',
        'is_pengaduan',
        'saran_pengaduan',
        'tanggal_notifikasi',
        'tanggal_kategorisasi',
        'tanggal_tl_pj_layanan',
        'text_pj_layanan',
        'tanggal_tl_pj_pengaduan',
        'text_pj_pengaduan',
        'kode_satker_id',
        'selesai',
        'tanggal_selesai'
    ];

    protected $casts = [
        'kode_saran'              => 'array',
        'created_at'              => 'datetime',
        'updated_at'              => 'datetime',
        'tanggal_selesai'         => 'datetime',
        'tanggal_tl_pj_pengaduan' => 'datetime',
        'tanggal_tl_pj_layanan'   => 'datetime',
        'tanggal_notifikasi'      => 'datetime',
        'tanggal_kategorisasi'    => 'datetime'
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
