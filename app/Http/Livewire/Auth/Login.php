<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use InvalidArgumentException;
use Livewire\Component;
use Livewire\Redirector;
use Throwable;
use RuntimeException;

class Login extends Component
{
    public $username;
    public $password;

    // Rule Validasi Form
    protected $rules = [
        'username' => 'required|string|min:5',
        'password' => 'required|string|min:5'
    ];

    // Pesan Error Validasi Form
    protected $messages = [
        'username.required' => 'Username tidak boleh kosong',
        'username.min'      => 'Username minimal 5 karakter',
        'password.required' => 'Password tidak boleh kosong',
        'password.min'      => 'Password minimal 5 karakter'
    ];

    /**
     * Render Komponen Login
     * @return View
     * @throws BindingResolutionException
     */
    public function render() : View
    {
        return view('livewire.auth.login')
            -> layout('layouts.auth');
    }

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended(env('APP_URL') . '/dashboard');
        } else {
            // sweetalert
        }
    }
}
