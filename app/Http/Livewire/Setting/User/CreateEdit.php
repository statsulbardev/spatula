<?php

namespace App\Http\Livewire\Setting\User;

use App\Models\m_akses;
use App\Models\m_pengguna;
use App\Models\m_satker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class CreateEdit extends Component
{
    public $user;
    public $satker;
    public $roles;

    public $fullname;
    public $email;
    public $password;
    public $bpsid;
    public $unit;
    public $role;
    public $photo;

    public function mount(m_pengguna $username)
    {
        switch (explode('/', Route::getCurrentRoute()->uri)[2])
        {
            case 'create' :
                if (Auth::user()->role_id === 1) {
                    $this->roles  = m_akses::get(['kode_akses', 'nama_akses']);
                    $this->satker = m_satker::get(['kode_satker', 'nama']);
                } else {
                    $this->roles  = m_akses::where('id', '>', 1)->get(['kode_akses', 'nama_akses']);
                    $this->satker = m_satker::where('id', Auth::user()->kode_satker_id)->get(['kode_satker', 'nama']);
                }

                break;
            case 'edit' :
                $this->user     = $username;
                $this->fullname = $this->user->nama;
                $this->email    = $this->user->email;
                $this->bpsid    = $this->user->bpsid;
                $this->unit     = $this->user->kd_satker_id;
                $this->role     = $this->user->role_id;
                $this->photo    = $this->user->foto;

                $this->roles    = m_akses::get(['kode_akses', 'nama_akses']);
                $this->satker   = m_satker::get(['kode_satker', 'nama']);

                break;
        }
    }

    public function render()
    {
        return view('livewire.setting.user.create-edit')
            -> layout('layouts.app');
    }
}
