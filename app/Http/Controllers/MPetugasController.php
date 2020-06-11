<?php

namespace App\Http\Controllers;

use App\Models\m_pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id === 1) {
            return view('backend.petugas.index', [
                'operators' => m_pengguna::where('role_id', 7)->paginate(15)
            ]);
        } else {
            return view('backend.petugas.index', [
                'operators' => m_pengguna::where('kode_satker_id', Auth::user()->kode_satker_id)->where('role_id', 7)->paginate(15)
            ]);
        }
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
        $user = m_pengguna::findOrFail($id);

        $user->update([
            'aktif' => $request->state
        ]);

        return redirect()->back();
    }
}
