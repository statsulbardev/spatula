<?php

namespace App\Http\Livewire\Antrian\Traits;

use App\Models\d_antrian_satker;

trait Helper_Auth
{
    function auth_antrian_check()
    {
        if(session('check_have_antrian_auth', null)){
            return true;
        }
        return false;
    }

    function auth_antrian_register($konsumen_email, $konsumen_no_wa_telepon, $konsumen_tahun_lahir, $konsumen_nama)
    {
        $effected_row = d_antrian_satker::where('konsumen_email', $konsumen_email)
            ->where('konsumen_no_wa_telepon', $konsumen_no_wa_telepon)
            ->where('konsumen_tahun_lahir', $konsumen_tahun_lahir)
            ->update(['konsumen_nama' => $konsumen_nama]);

        $is_registrasi = 1;
        if($effected_row > 0)
        {
            $is_registrasi = 0;
        }

        session([
            'check_have_antrian_auth' => 1,
            'konsumen_email' => $konsumen_email,
            'konsumen_no_wa_telepon' => $konsumen_no_wa_telepon,
            'konsumen_tahun_lahir' => $konsumen_tahun_lahir,
            'konsumen_nama' => $konsumen_nama,
            'is_registrasi' => $is_registrasi,
        ]);

        return 1;
    }

    function auth_antrian_login($konsumen_email, $konsumen_no_wa_telepon, $konsumen_tahun_lahir)
    {
        $one_antrian = d_antrian_satker::where('konsumen_email', $konsumen_email)
            ->where('konsumen_no_wa_telepon', $konsumen_no_wa_telepon)
            ->where('konsumen_tahun_lahir', $konsumen_tahun_lahir)
            ->first();
        if($one_antrian){
            $konsumen_nama = $one_antrian->konsumen_nama;
            session([
                'check_have_antrian_auth' => 1,
                'konsumen_email' => $konsumen_email,
                'konsumen_no_wa_telepon' => $konsumen_no_wa_telepon,
                'konsumen_tahun_lahir' => $konsumen_tahun_lahir,
                'konsumen_nama' => $konsumen_nama,
            ]);
            return 1;
        }else{
            return 0;
        }
    }

    function auth_antrian_logout()
    {
        session()->forget([])
        $one_antrian = d_antrian_satker::where('konsumen_email', $konsumen_email)
            ->where('konsumen_no_wa_telepon', $konsumen_no_wa_telepon)
            ->where('konsumen_tahun_lahir', $konsumen_tahun_lahir)
            ->first();
        if($one_antrian){
            $konsumen_nama = $one_antrian->konsumen_nama;
            session([
                'check_have_antrian_auth' => 1,
                'konsumen_email' => $konsumen_email,
                'konsumen_no_wa_telepon' => $konsumen_no_wa_telepon,
                'konsumen_tahun_lahir' => $konsumen_tahun_lahir,
                'konsumen_nama' => $konsumen_nama,
            ]);
            return 1;
        }else{
            return 0;
        }
    }

}