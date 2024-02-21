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

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'id_antrian_satker_layanan',
        'id_satker',
        'id_layanan',
        'konsumen_nama',
        'konsumen_tahun_lahir',
        'konsumen_email',
        'konsumen_no_wa_telepon',
        'tanggal',
        'antrian',
        'deskripsi',
    ];
}
