<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function render()
    {
        return view('livewire.auth.login')
            -> layout('layouts.auth');
    }

    protected $rules = [
        'username' => 'required|string',
        'password' => 'required'
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended(env('APP_URL') . '/dashboard');
        } else {
            $this->addError('error', 'Otentikasi gagal, periksan kembali.');
        }
    }
}
