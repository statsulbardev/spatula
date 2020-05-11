<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_satker extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_satker';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'kode_satker',
        'nama',
        'level',
    ];
}
