<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_antrian_satker_layanan extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_antrian_satker_layanan';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'id_satker',
        'id_layanan'
    ];
}
