<?php

namespace App\Http\Livewire\Setting\User;

use App\Models\m_pengguna;
use App\Repositories\MPenggunaRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    public $users;
    public $userData;


    public function mount()
    {
        if (Auth::user()->role_id === 1) {
            $this->users = m_pengguna::get();
        } elseif (Auth::user()->role_id === 2 || Auth::user()->role_id === 3) {
            $this->users = m_pengguna::query()
                           -> where('kode_satker_id', Auth::user()->kode_satker_id)
                           -> where('role_id', '>', 1)
                           -> get();
        } else {
            $this->users = m_pengguna::query()
                           -> where('id', Auth::id())
                           -> get();
        }
    }

    public function data(m_pengguna $data)
    {
        $this->userData = $data;
    }

    public function render()
    {
        return view('livewire.setting.user.lists')
            -> layout('layouts.app');
    }

    public function deleteId(m_pengguna $id)
    {
        $this->userData = $id;
    }

    public function delete(MPenggunaRepository $mPenggunaRepository)
    {
        $result = $mPenggunaRepository->delete($this->userData);

        session()->flash('message', $result);

        return redirect(env('APP_URL') . '/setting/user/lists');
    }
}
