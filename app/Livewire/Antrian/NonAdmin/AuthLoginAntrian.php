<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\NonAdmin;

use App\Traits\Antrian\Helper_Auth;
use Illuminate\contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthLoginAntrian extends Component
{
    use Helper_Auth;

    public $konsumen_email;
    public $konsumen_no_wa_telepon;
    public $konsumen_tahun_lahir;
    public $error_login_text = '';

    private $rules = [
        'konsumen_email' => 'required|email',
        'konsumen_no_wa_telepon' => 'required|numeric|digits_between:10,13',
        'konsumen_tahun_lahir' => 'required|numeric|digits:4|min:1900',
    ];

    private $messages = [
        'konsumen_email.required' => 'Password tidak boleh kosong',
        'konsumen_email.email'      => 'Password minimal 5 karakter',
        'konsumen_no_wa_telepon.required' => 'No hp tidak boleh kosong',
        'konsumen_no_wa_telepon.numeric'      => 'No hp hanya boleh angka',
        'konsumen_no_wa_telepon.digits_between' => 'No hp tidak sesuai format',
        'konsumen_tahun_lahir.required' => 'Tahun lahir tidak boleh kosong',
        'konsumen_tahun_lahir.numeric'      => 'Tahun lahir hanya boleh angka',
        'konsumen_tahun_lahir.digits' => 'Tahun lahir tidak sesuai',
        'konsumen_tahun_lahir.min' => 'Tahun lahir tidak sesuai',
    ];

    public function mount()
    {
        if($this->auth_antrian_check()){
            return redirect('antrian-non-admin-lihat');
        }
    }

    #[Title('Login Antrian')]
    public function render(): View
    {
        return view('livewire.antrian.non-admin.auth_login_antrian')
            ->layout('components.layouts.antrian-auth');
    }

    public function submit_auth()
    {
        $this->validate($this->rules, $this->messages);

        $result = $this->auth_antrian_login($this->konsumen_email, $this->konsumen_no_wa_telepon, $this->konsumen_tahun_lahir);

        if ($result === 1) {
            return redirect()->route('antrian-non-admin-lihat');
        }else{
            $this->error_login_text = 'Tidak terdapat user dengan informasi yang tersedia';
        }

    }

}
