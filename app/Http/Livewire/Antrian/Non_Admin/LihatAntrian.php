<?php

namespace App\Http\Livewire\Antrian\Non_Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class ItemLihatTambahUbah extends Component
{
    public function render() : View
    {
        return view('livewire.antrian.non_admin.lihat_antrian')->layout('layouts.auth');
    }

    public function submit_auth_login($form_data)
    {
        
    }

    public function submit_auth_registrasi ($form_data)
    {
        
    }

}
