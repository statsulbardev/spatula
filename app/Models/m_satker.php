<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class m_satker extends Model
{
    use Searchable;

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
        'alamat',
        'web',
        'telepon'
    ];

    public function pengguna()
    {
        return $this->hasMany(m_pengguna::class, 'kode_satker_id');
    }

    public function penilaian()
    {
        return $this->hasMany(d_penilaian::class, 'kode_satker_id', 'kode_satker');
    }

    #[SearchUsingPrefix(['nama', 'alamat'])]
    #[SearchUsingFullText(['kode_satker'])]
    public function toSearchableArray(): array
    {
        return [
            'kode_satker' => $this->kode_satker,
            'nama'        => $this->nama,
            'alamat'      => $this->alamat,
        ];
    }
}
