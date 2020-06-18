<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use App\Models\m_pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id === 1) {
            $petugasAktif     = m_pengguna::where('role_id', 7)->where('aktif', 1)->count();
            $penilaianPetugas = d_penilaian::whereNotNull('kode_petugas')->count();
            $penilaianLayanan = d_penilaian::whereNull('kode_petugas')->count();
            $jumlahPengaduan  = d_penilaian::count('is_pengaduan', 1);
        } else {
            $kode = $this->getSatkerKode();
            $petugasAktif     = m_pengguna::where('kode_satker_id', Auth::user()->kode_satker_id)->where('role_id', 7)->where('aktif', 1)->count();
            $penilaianPetugas = d_penilaian::where('kode_satker_id', $kode->kode_satker)->whereNotNull('kode_petugas')->count();
            $penilaianLayanan = d_penilaian::where('kode_satker_id', $kode->kode_satker)->whereNull('kode_petugas')->count();
            $jumlahPengaduan  = d_penilaian::where('kode_satker_id', $kode->kode_satker)->count('is_pengaduan', 1);
        }

        return view('backend.dashboard.index', compact('petugasAktif', 'penilaianPetugas', 'penilaianLayanan', 'jumlahPengaduan'));
    }

    private function getSatkerKode()
    {
        $userId = Auth::user()->id;
        $userSatkerId = m_pengguna::find($userId);
        $kodeSatker = $userSatkerId->satker()->first('kode_satker');

        return $kodeSatker;
    }
}
