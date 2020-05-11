<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class d_penilaian extends Model
{
    protected $table = 'd_penilaian';

    protected $fillable = [

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
        return $this->belongsTo(m_saran::class, 'kategori_saran');
    }
}
