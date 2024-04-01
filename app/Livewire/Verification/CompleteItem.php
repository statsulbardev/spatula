<?php

declare(strict_types=1);

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class CompleteItem extends Component
{
    public $done;

    public function mount(d_penilaian $customer)
    {
        $this->done = $customer;
    }

    #[Title('Verifikasi Layanan')]
    public function render(): View
    {
        return view('livewire.verification.complete-item');
    }
}
