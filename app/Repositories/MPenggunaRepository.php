<?php

namespace App\Repositories;

use App\Models\m_pengguna;

class MPenggunaRepository
{
    public function store($request)
    {
        m_pengguna::create([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => $request->satker,
            'aktif'          => true,
            // 'foto'           => $request->file('photo') ? Storage::disk('bps')->put('') : null
        ]);
    }

    public function update($m_pengguna, $request)
    {

    }
}
