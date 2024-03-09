<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $error_login_text;

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

    public function mount()
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
    }

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
        $this->dispatch('saved');
        $this->error_login_text = '';
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended(env('APP_URL') . '/dashboard');
        } else {
            // sweetalert
            $this->error_login_text = 'Gagal login dengn info yang tersedia!';
        }
    }
}
