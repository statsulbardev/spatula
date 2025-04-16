<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Livewire\Forms\AuthenticationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public AuthenticationForm $form;

    public function mount()
    {
        if (Auth::check())
            return $this->redirectIntended('dashboard', navigate: true);
    }

    #[Title('Login Spatula')]
    public function render(): View
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.auth');
    }

    public function login()
    {
        $this->dispatch('validate');

        if (Auth::attempt($this->form->validate())) {
            request()->session()->regenerate();

            return $this->redirectIntended('dashboard', navigate: true);
        }

        throw ValidationException::withMessages([
            'form.username' => 'Username tidak terdaftar pada aplikasi ini.',
            'form.password' => 'Password tidak terdaftar pada aplikasi ini.'
        ]);
    }
}
