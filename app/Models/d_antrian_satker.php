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
        'is_active',
        'antrian',
        'konsumen_email',
        'konsumen_no_wa_telepon',
        'deskripsi',
    ];
}
