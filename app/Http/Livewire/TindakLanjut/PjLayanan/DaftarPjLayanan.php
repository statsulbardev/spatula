<?php

namespace App\Http\Livewire\TindakLanjut\PJLayanan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPjLayanan extends Component
{
    use UnitCode, WithPagination;

    public $services;

    public function mount()
    {
        $this->services = Auth::user()->hasRole('superadmin')
            ? d_penilaian::where('selesai', 0)->latest('created_at')->get()
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 0)
                         ->latest('created_at')
                         ->get();
    }

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-layanan.daftar-pj-layanan')
            -> layout('layouts.app');
    }
}
