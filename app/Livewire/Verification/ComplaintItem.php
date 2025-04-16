<?php

declare(strict_types=1);

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use Livewire\Attributes\Title;
use Livewire\Component;

class ComplaintItem extends Component
{
    public $complaint;

    #[Title('Detail Verifikasi Pengaduan')]
    public function render()
    {
        return view('livewire.verification.complaint-item')
            ->layout('components.layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->complaint = $customer;
    }
}
