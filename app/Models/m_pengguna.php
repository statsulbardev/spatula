<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'remember_token',
        'bpsid',
        'foto',
        'kode_satker_id',
        'is_petugas'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function satker()
    {
        return $this->hasOne(m_satker::class, 'kode_satker', 'kode_satker_id');
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
