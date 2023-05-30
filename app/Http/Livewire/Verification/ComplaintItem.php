<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use Livewire\Component;

class ComplaintItem extends Component
{
    public $complaint;

    public function render()
    {
        return view('livewire.verification.complaint-item')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->complaint = $customer;
    }
}
