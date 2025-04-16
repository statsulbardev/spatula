<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\NonAdmin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class LihatAntrian extends Component
{
    #[Title('Daftar Layanan Antrian')]
    public function render(): View
    {
        return view('livewire.antrian.non-admin.lihat_antrian')
            ->layout('components.layouts.antrian-app');
    }
}
