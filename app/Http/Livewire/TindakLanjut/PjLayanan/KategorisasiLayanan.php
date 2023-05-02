<?php

namespace App\Http\Livewire\TindakLanjut\PjLayanan;

use App\Models\d_penilaian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\Redirector;

class KategorisasiLayanan extends Component
{
    public $customer;
    public $routeName;

    public $cb_saran;
    public $cb_pengaduan;
    public $cb_kritik;
    public $cb_apresiasi;
    public $cb_lainnya;

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-layanan.kategorisasi-layanan')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->routeName = Route::currentRouteName();
        $this->customer  = $customer;

        if ($this->routeName === 'edit-kategorisasi-layanan') {
            $this->cb_saran     = in_array(1, $customer->kode_saran) ?? false;
            $this->cb_pengaduan = in_array(2, $customer->kode_saran) ?? false;
            $this->cb_kritik    = in_array(3, $customer->kode_saran) ?? false;
            $this->cb_apresiasi = in_array(4, $customer->kode_saran) ?? false;
            $this->cb_lainnya   = in_array(9, $customer->kode_saran) ?? false;
        }
    }

    public function storeData() : Redirector
    {
        $data = [
            $this->cb_saran ? 1 : null,
            $this->cb_pengaduan ? 2 : null,
            $this->cb_kritik ? 3 : null,
            $this->cb_apresiasi ? 4 : null,
            $this->cb_lainnya ? 9 : null,
        ];

        if (count(array_filter($data)) === 0) return redirect()->back();

        $this->cb_pengaduan
            ? $this->customer->update([
                    'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                    'is_pengaduan' => 1,
                    'tanggal_kategorisasi' => Carbon::now()
                ])
            : $this->customer->update([
                    'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                    'is_pengaduan' => 0,
                    'tanggal_kategorisasi' => Carbon::now()
            ]);

        session()->flash('messages', 'Kategorisasi telah disimpan.');

        return $this->callbackUrl();
    }

    private function callbackUrl() : Redirector
    {
        return redirect(env('APP_URL') . '/verifikasi/pj-layanan');
    }
}
