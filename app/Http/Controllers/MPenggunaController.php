<?php

namespace App\Http\Controllers;

use App\Models\m_akses;
use App\Models\m_pengguna;
use App\Models\m_satker;
use Illuminate\Http\Request;

class MPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pengguna.index', [
            'users' => m_pengguna::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengguna.create', [
            'roles'  => m_akses::get(['kode_akses', 'nama_akses']),
            'satker' => m_satker::get(['kode_satker', 'nama'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:30',
            'username' => 'required|string|max:20',
            'email'    => 'required|email:rfc',
            'password' => 'required|string|max:20',
            'bpsid'    => 'nullable|string|max:9',
            'satker'   => 'required',
            'role'     => 'required',
            'photo'    => 'nullable'
        ]);

        m_pengguna::create([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => $request->satker,
            'aktif'          => true,
            'foto'           => $request->file('photo') ? $request->file('photo')->store('public/image') : null
        ]);

        return redirect()->route('pengguna')->with('success', 'Informasi ' . $request->nama . ' Telah Ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = m_pengguna::findOrFail($id);

        return view('backend.pengguna.edit', [
            'user'   => $user,
            'roles'  => m_akses::get(['kode_akses', 'nama_akses']),
            'satker' => m_satker::get(['kode_satker', 'nama']),
            'selected_satker' => $user->kode_satker_id,
            'selected_role' => $user->role_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        return redirect()->route('pengguna')->with('success', 'Informasi ' . $request->nama . ' Telah Diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = m_pengguna::findOrFail($id);

        $user->delete();

        return redirect()->route('pengguna')->with('success', 'Informasi ' . $user->nama . ' Telah Dihapus.');
    }
}
