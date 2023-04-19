<?php

namespace App\Http\Livewire\TindakLanjut\Selesai;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSelesai extends Component
{
    use UnitCode, WithPagination;

    public $dones;

    public function mount()
    {
        $this->dones = Auth::user()->hasRole('superadmin')
            ? d_penilaian::where('selesai', 1)->orderBy('tanggal_selesai', 'desc')->get()
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 1)
                         ->orderBy('tanggal_selesai', 'desc')
                         ->get();
    }

    public function render()
    {
        return view('livewire.tindak-lanjut.selesai.daftar-selesai')
            -> layout('layouts.app');
    }
}
