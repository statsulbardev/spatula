<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_saran extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_saran';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'kode_saran',
        'nama_saran'
    ];
}
