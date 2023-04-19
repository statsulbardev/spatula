<?php

namespace App\Http\Livewire\TindakLanjut\Selesai;

use App\Models\d_penilaian;
use Livewire\Component;

class DetailSelesai extends Component
{
    public $done;

    public function render()
    {
        return view('livewire.tindak-lanjut.selesai.detail-selesai')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->done = $customer;
    }
}
