<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function firstForm()
    {
        return view('frontend.first-form', [
            'petugas'   => m_pengguna::get(['id', 'nama']),
            'j_layanan' => m_layanan::get(['id', 'nama_layanan'])
        ]);
    }

    public function secondForm()
    {
        return view('frontend.second-form', [
            'j_layanan' => m_layanan::get(['id', 'nama_layanan'])
        ]);
    }

    public function storeFirstForm(Request $request)
    {
        $request->validate([
            'nama_konsumen'   => 'required|string',
            'email_konsumen'  => 'nullable|email',
            'no_wa_telepon'   => 'nullable',
            'saran_pengaduan' => 'required|string'
        ]);

        d_penilaian::insert([
            'nama_konsumen'   => $request->nama_konsumen,
            'email_konsumen'  => $request->email_konsumen,
            'no_wa_telepon'   => $request->no_wa_telepon,
            'kode_petugas'    => $request->kode_petugas,
            'rating_petugas'  => $request->rating_layanan,
            'kode_layanan'    => $request->kode_layanan,
            'rating_layanan'  => $request->rating_layanan,
            'saran_pengaduan' => $request->saran_pengaduan
        ]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        dd($request);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
