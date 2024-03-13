<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class d_antrian_satker extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'd_antrian_satker';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $dates = ['antrian'];

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'kode_satker',
        'kode_layanan',
        'konsumen_nama',
        'konsumen_tahun_lahir',
        'tanggal',
        'status',
        'antrian',
        'konsumen_email',
        'konsumen_no_wa_telepon',
        'deskripsi',
        'sudah_nilai'
    ];

    public function satker()
    {
        return $this->hasOne(m_satker::class, 'kode_satker', 'kode_satker');
    }


    public function layanan()
    {
        return $this->hasOne(m_layanan::class, 'kode_layanan', 'kode_layanan');
    }


}
