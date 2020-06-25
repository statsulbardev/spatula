<?php

namespace App\Repositories;

use App\Models\d_penilaian;
use Carbon\Carbon;

class PenilaianLayananRepository
{
    public function store($request, $satker)
    {
        d_penilaian::insert([
            'nama_konsumen'   => $request->nama_konsumen,
            'email_konsumen'  => $request->email_konsumen,
            'no_wa_telepon'   => $request->no_wa_telepon,
            'kode_layanan'    => $request->kode_layanan,
            'rating_layanan'  => $request->rating_layanan,
            'saran_pengaduan' => $request->saran_pengaduan,
            'kode_satker_id'  => $satker,
            'selesai'         => false,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);
    }
}
