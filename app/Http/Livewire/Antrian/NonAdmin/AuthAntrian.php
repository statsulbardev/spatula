<?php

namespace App\Http\Livewire\Antrian\NonAdmin;

use App\Http\Livewire\Antrian\Traits\Helper_Auth;
use Illuminate\View\View;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthAntrian extends Component
{
    use Helper_Auth;

    public $type = 0; //0 login 1 registrasi
    public $konsumen_email;
    public $konsumen_no_wa_telepon;
    public $konsumen_tahun_lahir;
    public $konsumen_nama;
    public $error_login_text = '';

    private $rules_01 = [
        'type' => 'bail|required|in:0,1',
        'konsumen_email' => 'required|email',
        'konsumen_no_wa_telepon' => 'required|numeric|digits_between:10,13',
        'konsumen_tahun_lahir' => 'required|numeric|digits:4|min:1900',
    ];

    private $messages_01 = [
        'type.required' => 'Tipe harus terisi',
        'type.in'      => 'Tipe tidak sesuai pilihan',
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

    private $rules_02 = [
        'type' => 'bail|required|in:0,1',
        'konsumen_email' => 'required|email',
        'konsumen_no_wa_telepon' => 'required|numeric|digits_between:10,13',
        'konsumen_tahun_lahir' => 'required|numeric|digits:4|min:1900',
        'konsumen_nama' => 'required|string',
    ];

    private $messages_02 = [
        'type.required' => 'Tipe harus terisi',
        'type.in'      => 'Tipe tidak sesuai pilihan',
        'konsumen_email.required' => 'Password tidak boleh kosong',
        'konsumen_email.email'      => 'Password minimal 5 karakter',
        'konsumen_no_wa_telepon.required' => 'No hp tidak boleh kosong',
        'konsumen_no_wa_telepon.numeric'      => 'No hp hanya boleh angka',
        'konsumen_no_wa_telepon.digits_between' => 'No hp tidak sesuai format',
        'konsumen_tahun_lahir.required' => 'Tahun lahir tidak boleh kosong',
        'konsumen_tahun_lahir.numeric'      => 'Tahun lahir hanya boleh angka',
        'konsumen_tahun_lahir.digits' => 'Tahun lahir tidak sesuai',
        'konsumen_tahun_lahir.min' => 'Tahun lahir tidak sesuai',
        'konsumen_nama.required' => 'Nama tidak boleh kosong',
        'konsumen_nama.string' => 'Nama adalah text',
    ];

    public function mount()
    {
        if($this->auth_antrian_check()){
            return redirect('antrian-non-admin-lihat');
        }
    }

    public function render() : View
    {
        return view('livewire.antrian.non-admin.auth_antrian')->layout('layouts.auth_antrian');
    }

    public function submit_auth()
    {
        if(!is_null($this->type)){
            if($this->type == 0){
                $this->validate($this->rules_01, $this->messages_01);
            }else if($this->type == 0){
                $this->validate($this->rules_02, $this->messages_02);
            }
        }


        if(Carbon::today()->year - $this->konsumen_tahun_lahir <= 10){
            $this->addError('konsumen_tahun_lahir', 'Tahun lahir terlalu awal');
            return;
        }

        if( ! (str_starts_with($this->konsumen_no_wa_telepon, '0') or str_starts_with($this->konsumen_no_wa_telepon, '62'))){
            $this->addError('konsumen_no_wa_telepon', 'No hp tidak sesuai format');
            return;
        }

        $result = -1;
        if($this->type == 0){
            $result = $this->auth_antrian_login($this->konsumen_email, $this->konsumen_no_wa_telepon, $this->konsumen_tahun_lahir);
        }else if($this->type == 1){
            $result = $this->auth_antrian_register($this->konsumen_email, $this->konsumen_no_wa_telepon, $this->konsumen_tahun_lahir, $this->konsumen_nama);
        }

        if ($result === 1) {
            return redirect()->route('antrian-non-admin-lihat');
        }else{
            $this->error_login_text = 'Tidak terdapat user dengan informasi yang tersedia';
        }
        
    }

}
