<?php

namespace App\Http\Livewire\TindakLanjut\PJLayanan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class DaftarPjLayanan extends Component
{
    use UnitCode, WithPagination;

    public $services;

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-layanan.daftar-pj-layanan')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->services = Auth::user()->hasRole('superadmin')
            ? d_penilaian::query()
                        -> where('selesai', 0)
                        -> latest('created_at')
                        -> get()
            : d_penilaian::query()
                        -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                        -> where('selesai', 0)
                        -> latest('created_at')
                        -> get();
    }

    public function finalizeServiceItem($id) : Redirector
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        session()->flash('messages', 'Finalisasi verifikasi selesai dilakukan');

        return $this->callbackUrl();
    }

    public function deleteServiceItem($id) : Redirector
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->destroy($id);

        session()->flash('messages', 'Item penilaian telah dihapus');

        return $this->callbackUrl();
    }

    private function callbackUrl()
    {
        return redirect(env('APP_URL') . '/tindak-lanjut/pj-layanan');
    }
}
