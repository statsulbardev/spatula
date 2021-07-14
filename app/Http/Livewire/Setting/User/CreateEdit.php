<?php

namespace App\Http\Livewire\Setting\User;

use App\Models\m_akses;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\MPenggunaRepository;
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
    public $photoExtension;
    public $urlPhoto;

    protected $listeners = ['photo', 'photoExtension'];

    protected $rules = [

    ];

    public function mount(m_pengguna $username)
    {
        switch (explode('/', Route::getCurrentRoute()->uri)[2])
        {
            case 'create' :
                if (Auth::user()->role_id === 1) {
                    $this->roles  = m_akses::get(['id', 'kode_akses', 'nama_akses']);
                    $this->satker = m_satker::get(['id', 'kode_satker', 'nama']);
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
                $this->unit     = $this->user->kode_satker_id;
                $this->role     = $this->user->role_id;
                $this->urlPhoto = $this->user->foto;

                $this->roles    = m_akses::get(['id', 'kode_akses', 'nama_akses']);
                $this->satker   = m_satker::get(['id', 'kode_satker', 'nama']);

                break;
        }
    }

    public function photo($photo)
    {
        $this->photo = $photo;
    }

    public function photoExtension($photoExtension)
    {
        $this->photoExtension = $photoExtension;
    }

    public function render()
    {
        return view('livewire.setting.user.create-edit')
            -> layout('layouts.app');
    }

    public function save(MPenggunaRepository $mPenggunaRepository)
    {
        if (is_null($this->user)) {
            $result = $mPenggunaRepository->store($this);

            session()->flash('message', $result);

            return redirect(env('APP_URL') . '/setting/user/lists');
        } else {
            $result = $mPenggunaRepository->update($this);

            session()->flash('message', $result);

            return redirect(env('APP_URL') . '/setting/user/lists');
        }
    }
}
