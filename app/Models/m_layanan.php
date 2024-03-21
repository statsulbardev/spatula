<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class m_layanan extends Model
{
    use Searchable;

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
        'metode'
    ];

    public function toSearchableArray(): array
    {
        return [
            'kode_layanan' => $this->kode_layanan,
            'nama_layanan' => $this->nama_layanan,
            'deskripsi'    => $this->deskripsi,
        ];
    }

    public function satker()
    {
        return $this->belongsToMany(m_satker::class, 'm_satker_layanan');
    }
}
