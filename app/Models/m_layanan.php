<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_layanan extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_layanan';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'kode_layanan',
        'nama_layanan',
        'deskripsi',
        'kode_form'
    ];
}
