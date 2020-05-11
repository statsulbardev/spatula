<?php

namespace App\Http\Controllers;

use App\Models\m_pengguna;
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
        return view('backend.pengguna.create');
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
            'kode_satker_id' => null,
            'aktif'          => true,
            'foto'           => $request->file('photo') ? $request->file('photo')->store('public/image') : null
        ]);

        return redirect()->route('pengguna')->with('success', 'Informasi ' . $request->nama . ' Telah Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'user' => $user
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
        // $request->validate([
        //     'fullname' => 'required|string|max:30',
        //     'username' => 'required|string|max:20',
        //     'email'    => 'required|email:rfc',
        //     'password' => 'required|string|max:20',
        //     'bpsid'    => 'nullable|string|max:9',
        //     'role'     => 'required',
        //     'state'    => 'required',
        //     'photo'    => 'nullable'
        // ]);

        m_pengguna::where('id', $id)->update([
            'nama'           => $request->fullname,
            'username'       => $request->username,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'bpsid'          => $request->bpsid,
            'role_id'        => $request->role,
            'kode_satker_id' => null,
            'aktif'          => $request->state,
            'foto'           => $request->file('photo') ? $request->file('photo')->store('public/image') : null
        ]);

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
