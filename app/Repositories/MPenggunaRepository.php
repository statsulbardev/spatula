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

    public function update($id, $request)
    {
        m_pengguna::where('id', $id)->update([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => $request->satker,
        ]);

        if(!is_null($request->password)) {
            m_pengguna::where('id', $id)->update([
                'password' => bcrypt($request->password)
            ]);
        }

        if(!is_null($request->file('photo'))) {
            m_pengguna::where('id', $id)->update([
                'foto' => $request->file('photo')->store('public/image')
            ]);
        }
    }
}
