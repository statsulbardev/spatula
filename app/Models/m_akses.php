<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_akses extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_akses';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'kode_akses',
        'nama_akses'
    ];
}
