<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class d_antrian_satker_config_view extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'd_antrian_satker_config_view';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'id_antrian_satker_layanan',
        'id_satker',
        'id_layanan',
        'config_key',
        'config_index',
        'config_value'
    ];
}
