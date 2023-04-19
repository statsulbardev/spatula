<?php

namespace App\Http\Livewire\TindakLanjut\PjPengaduan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPjPengaduan extends Component
{
    use UnitCode, WithPagination;

    public $complaints;

    public function mount()
    {
        $this->complaints = Auth::user()->hasRole('superadmin')
            ? d_penilaian::where('selesai', 0)->where('is_pengaduan', 1)->get()
            : d_penilaian::where('selesai', 0)
                    ->where('kode_satker_id', $this->getUnitCode()->kode_satker)
                    ->where('is_pengaduan', 1)
                    ->get();
    }

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-pengaduan.daftar-pj-pengaduan')
            -> layout('layouts.app');
    }
}
