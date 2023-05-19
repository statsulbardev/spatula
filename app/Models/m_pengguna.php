<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Spatie\Permission\Traits\HasRoles;

class m_pengguna extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, Searchable;

    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'm_pengguna';

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'bpsid',
        'foto',
        'kode_satker_id',
        'aktif'
    ];

    /**
     * Atribut yang harus disembunyikan untuk array.\
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function satker()
    {
        return $this->hasOne(m_satker::class, 'id', 'kode_satker_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'nama'     => $this->nama,
            'username' => $this->username,
            'email'    => $this->email,
            'bpsid'    => $this->bpsid,
        ];
    }
}
