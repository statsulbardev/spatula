<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class d_penilaian extends Model
{
    use Searchable;

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
        'tanggal_selesai',
        'catatan'
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
        return $this->belongsTo(m_pengguna::class, 'kode_petugas', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(m_layanan::class, 'kode_layanan', 'kode_layanan');
    }

    public function saran()
    {
        return $this->belongsTo(m_saran::class, 'kode_saran', 'kode_saran');
    }

    public function toSearchableArray(): array
    {
        return [
            'nama_konsumen'     => $this->nama_konsumen,
            'email_konsumen'    => $this->email_konsumen,
            'no_wa_telepon'     => $this->no_wa_telepon,
            'saran_pengaduan'   => $this->saran_pengaduan,
            'text_pj_layanan'   => $this->text_pj_layanan,
            'text_pj_pengaduan' => $this->text_pj_pengaduan,
            'catatan'           => $this->catatan
        ];
    }
}
