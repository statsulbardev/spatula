<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use Livewire\Component;

class CompleteItem extends Component
{
    public $done;

    public function render()
    {
        return view('livewire.verification.complete-item')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->done = $customer;
    }
}
