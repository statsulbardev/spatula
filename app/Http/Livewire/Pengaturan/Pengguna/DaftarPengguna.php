<?php

namespace App\Http\Livewire\Pengaturan\Pengguna;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\UnitCode;
use App\Repositories\MPenggunaRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPengguna extends Component
{
    use UnitCode, WithPagination;

    public $users;
    public $userData;
    public $units;

    public function render()
    {
        return view('livewire.pengaturan.pengguna.daftar-pengguna')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->units = m_satker::get();

        if (Auth::user()->hasRole('superadmin')) {
            $this->users = m_pengguna::get();
        } elseif (Auth::user()->hasRole('admin') || Auth::user()->hasRole('pimpinan')) {
            $this->users = m_pengguna::query()
                            -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
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
