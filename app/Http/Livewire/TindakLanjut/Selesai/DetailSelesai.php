<?php

namespace App\Http\Livewire\TindakLanjut\Selesai;

use App\Models\d_penilaian;
use Livewire\Component;

class DetailSelesai extends Component
{
    public $done;

    public function mount(d_penilaian $id)
    {
        $this->done = $id;
    }

    public function render()
    {
        return view('livewire.tindak-lanjut.selesai.detail-selesai')
            -> layout('layouts.app');
    }
}
