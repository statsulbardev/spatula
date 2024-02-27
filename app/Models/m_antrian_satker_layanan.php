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
    public $incrementing = false;
    public $timestamps = true;

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'kode_satker',
        'kode_layanan',
        'loket',
        'is_active'
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
