<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();

        request()->session()->flush();

        return $this->redirectRoute('form-penilaian', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.logout');
    }
}
