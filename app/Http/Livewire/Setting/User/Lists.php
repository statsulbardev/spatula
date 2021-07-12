<?php

namespace App\Http\Livewire\Setting\User;

use App\Models\m_pengguna;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    public $users;

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

    public function render()
    {
        return view('livewire.setting.user.lists')
            -> layout('layouts.app');
    }
}
