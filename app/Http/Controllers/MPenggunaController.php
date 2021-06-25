<?php

namespace App\Http\Controllers;

use App\Http\Requests\MPenggunaValidation;
use App\Models\m_akses;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\MPenggunaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id === 1) {
            return view('backend.pengguna.index', [
                'users' => m_pengguna::paginate(10)
            ]);
        } elseif(Auth::user()->role_id === 2 || Auth::user()->role_id === 3) {
            return view('backend.pengguna.index', [
                'users' => m_pengguna::where('kode_satker_id', Auth::user()->kode_satker_id)->where('role_id', '>', 1)->paginate(10)
            ]);
        } else {
            return view('backend.pengguna.index', [
                'users' => m_pengguna::where('id', Auth::user()->id)->paginate(1)
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id === 1) {
            return view('backend.pengguna.create', [
                'roles'  => m_akses::get(['kode_akses', 'nama_akses']),
                'satker' => m_satker::get(['kode_satker', 'nama'])
            ]);
        } else {
            return view('backend.pengguna.create', [
                'roles'  => m_akses::where('id', '>', 1)->get(['kode_akses', 'nama_akses']),
                'satker' => m_satker::where('id', Auth::user()->kode_satker_id)->get(['kode_satker', 'nama'])
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MPenggunaValidation $request, MPenggunaRepository $repository)
    {
        $repository->store($request);

        alert()->success('Tambah Pengguna', $request->fullname . ' Telah Ditambahkan');

        return redirect()->to(env('APP_URL') . 'pengguna');
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
    public function update(MPenggunaValidation $request, MPenggunaRepository $repository, $id)
    {
        $repository->update($id, $request);

        alert()->success('Update Pengguna', 'Informasi ' . $request->fullname . ' telah diperbaharui.');

        return redirect()->to(env('APP_URL') . 'pengguna');
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

        alert()->success('Hapus Pengguna', 'Informasi ' . $user->nama . ' telah dihapus.');

        return redirect()->to(env('APP_URL') . 'pengguna');
    }
}
