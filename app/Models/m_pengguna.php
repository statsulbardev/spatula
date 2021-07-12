<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class m_pengguna extends Authenticatable
{
    use Notifiable;

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
        'role_id',
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
        return $this->belongsTo(m_satker::class, 'kode_satker_id');
    }

    public function role()
    {
        return $this->belongsTo(m_akses::class, 'role_id');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
