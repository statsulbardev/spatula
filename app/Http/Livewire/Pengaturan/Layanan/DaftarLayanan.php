<?php

namespace App\Http\Livewire\Pengaturan\Layanan;

use App\Models\m_layanan;
use Livewire\Component;

class DaftarLayanan extends Component
{
    public $services;

    public function render()
    {
        return view('livewire.pengaturan.layanan.daftar-layanan')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->services = m_layanan::get();
    }
}
