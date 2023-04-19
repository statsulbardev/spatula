<?php

namespace App\Http\Livewire\TindakLanjut\PjPengaduan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class DaftarPjPengaduan extends Component
{
    use UnitCode, WithPagination;

    public $complaints;

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-pengaduan.daftar-pj-pengaduan')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->complaints = Auth::user()->hasRole('superadmin')
            ? d_penilaian::where('selesai', 0)->where('is_pengaduan', 1)->get()
            : d_penilaian::where('selesai', 0)
                    ->where('kode_satker_id', $this->getUnitCode()->kode_satker)
                    ->where('is_pengaduan', 1)
                    ->get();
    }

    public function finalize($id) : Redirector
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        session()->flash('messages', 'Finalisasi verifikasi selesai dilakukan');

        return $this->callbackUrl();
    }

    private function callbackUrl() : Redirector
    {
        return redirect(env('APP_URL') . '/tindak-lanjut/pj-pengaduan');
    }
}
