<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\d_penilaian;
use App\Models\m_pengguna;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('dashboard'),
            'label' => 'Dashboard'
        ];
    }

    public $petugasAktif;
    public $penilaianPetugas;
    public $penilaianLayanan;
    public $jumlahPengaduan;

    // public function mount()
    // {
    //     if (Auth::user()->hasRole('superadmin')) {
    //         $this->petugasAktif     = m_pengguna::role('operator')->where('aktif', 1)->count();
    //         $this->penilaianPetugas = d_penilaian::whereNotNull('kode_petugas')->count();
    //         $this->penilaianLayanan = d_penilaian::where('rating_layanan', '>', 0)->count();
    //         $this->jumlahPengaduan  = d_penilaian::where('is_pengaduan', 1)->count();
    //     } else {
    //         $kode = $this->getSatkerKode();
    //         $this->petugasAktif     = m_pengguna::where('kode_satker_id', Auth::user()->kode_satker_id)->where('role_id', 7)->where('aktif', 1)->count();
    //         $this->penilaianPetugas = d_penilaian::where('kode_satker_id', $kode->kode_satker)->whereNotNull('kode_petugas')->count();
    //         $this->penilaianLayanan = d_penilaian::where('kode_satker_id', $kode->kode_satker)->where('rating_layanan', '>', 0)->count();
    //         $this->jumlahPengaduan  = d_penilaian::where('kode_satker_id', $kode->kode_satker)->where('is_pengaduan', 1)->count();
    //     }
    // }

    public function render()
    {
        return view('livewire.dashboard.index')->layout('layouts.app');
    }

    // private function getSatkerKode()
    // {
    //     $userSatkerId = m_pengguna::find(Auth::id());
    //     $kodeSatker   = $userSatkerId->satker()->first('kode_satker');

    //     return $kodeSatker;
    // }
}
