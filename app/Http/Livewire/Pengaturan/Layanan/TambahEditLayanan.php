<?php

namespace App\Http\Livewire\Pengaturan\Layanan;

use App\Models\m_layanan;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\Redirector;

class TambahEditLayanan extends Component
{
    public $routeName;
    public $serviceMaster;
    public $kode_layanan;
    public $nama_layanan;
    public $deskripsi;

    public function render()
    {
        return view('livewire.pengaturan.layanan.tambah-edit-layanan')
            -> layout('layouts.app');
    }

    public function mount(m_layanan $layanan)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'edit-layanan') {

            $this->serviceMaster = $layanan;

            $this->fillService($layanan);
        }
    }

    public function storeNewService() : Redirector
    {
        m_layanan::create([
            'kode_layanan' => $this->kode_layanan,
            'nama_layanan' => $this->nama_layanan,
            'deskripsi'    => $this->deskripsi,
            'kode_form'    => '1'
        ]);

        session()->flash('messages', 'Informasi Tersimpan !!');

        return $this->callbackUrl();
    }

    public function updateService() : Redirector
    {
        $this->serviceMaster->update([
            'kode_layanan' => $this->kode_layanan,
            'nama_layanan' => $this->nama_layanan,
            'deskripsi'    => $this->deskripsi
        ]);

        session()->flash('messages', 'Informasi Tersimpan !!');

        return $this->callbackUrl();
    }

    private function fillService($layanan)
    {
        $this->kode_layanan = $layanan->kode_layanan;
        $this->nama_layanan = $layanan->nama_layanan;
        $this->deskripsi    = $layanan->deskripsi;
    }

    private function callbackUrl() : Redirector
    {
        return redirect(url(env('APP_URL') . '/pengaturan/layanan'));
    }
}
