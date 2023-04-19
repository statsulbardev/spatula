<?php

namespace App\Http\Livewire\TindakLanjut\PjPengaduan;

use App\Models\d_penilaian;
use Livewire\Component;

class DetailPjPengaduan extends Component
{
    public $complaint;

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-pengaduan.detail-pj-pengaduan')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->complaint = $customer;
    }
}
