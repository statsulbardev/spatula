<?php

namespace App\Repositories;

use App\Models\m_pengguna;
use Illuminate\Support\Facades\Storage;

class MPenggunaRepository
{
    public function store($request)
    {
        if(!is_null($request->photo)) $path = Storage::putFile('image', $request->file('photo'));

        m_pengguna::create([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => $request->satker,
            'aktif'          => true,
            'foto'           => is_null($request->photo) ? null : $path
        ]);
    }

    public function update($id, $request)
    {
        if(!is_null($request->photo)) {
            $path = Storage::putFile('image', $request->file('photo'));

            m_pengguna::where('id', $id)->update(['foto' => $path]);
        }

        m_pengguna::where('id', $id)->update([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => $request->satker
        ]);

        if(!is_null($request->password)) {
            m_pengguna::where('id', $id)->update([
                'password' => bcrypt($request->password)
            ]);
        }
    }
}
