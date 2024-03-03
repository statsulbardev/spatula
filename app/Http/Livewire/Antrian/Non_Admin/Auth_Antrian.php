<?php

namespace App\Http\Livewire\Antrian\Non_Admin;

use App\Http\Livewire\Antrian\Traits\Helper_Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class Auth_Antrian extends Component
{
    use Helper_Auth;

    public $type; //0 login 1 registrasi
    public $konsumen_email;
    public $konsumen_no_wa_telepon;
    public $konsumen_tahun_lahir;
    public $konsumen_nama;

    protected $rules_01 = [
        'type' => 'required|string|min:5',
        'konsumen_email' => 'required|string|min:5',
        'konsumen_no_wa_telepon' => 'required|string|min:5',
        'konsumen_tahun_lahir' => 'required|string|min:5',
    ];

    protected $messages_01 = [
        'username.required' => 'Username tidak boleh kosong',
        'username.min'      => 'Username minimal 5 karakter',
        'password.required' => 'Password tidak boleh kosong',
        'password.min'      => 'Password minimal 5 karakter'
    ];

    protected $rules_02 = [
        'type' => 'required|string|min:5',
        'konsumen_email' => 'required|string|min:5',
        'konsumen_no_wa_telepon' => 'required|string|min:5',
        'konsumen_tahun_lahir' => 'required|string|min:5',
        'konsumen_nama' => 'required|string|min:5',
    ];

    protected $messages_02 = [
        'username.required' => 'Username tidak boleh kosong',
        'username.min'      => 'Username minimal 5 karakter',
        'password.required' => 'Password tidak boleh kosong',
        'password.min'      => 'Password minimal 5 karakter'
    ];

    public function mount()
    {
        if($this->auth_antrian_check()){
            return redirect('antrian-non_admin-lihat');
        }
    }

    public function render() : View
    {
        return view('livewire.antrian.non_admin.auth_antrian')->layout('layouts.auth_antrian');
    }

    public function submit_auth_login($form_data)
    {
        
    }

    public function submit_auth_registrasi ($form_data)
    {
        
    }

}
