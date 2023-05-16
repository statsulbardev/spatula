<?php

namespace App\Http\Livewire\Pengaturan\Pengguna;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\MPenggunaRepository;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

use Spatie\Permission\Models\Role;

class TambahEditPengguna extends Component
{
    use HasRedirectUrl, HasRenderOption;

    public $routeName;
    public $user;
    public $units;
    public $roles;

    public $f_name;
    public $f_email;
    public $f_password;
    public $f_bpsid;
    public $f_unit;
    public $f_role;

    public function render()
    {
        return view('livewire.pengaturan.pengguna.tambah-edit-pengguna')
            -> layout('layouts.app');
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->routeName = Route::currentRouteName();
        $this->units     = $this->renderUnitsOption(m_satker::get(['id', 'nama']));
        $this->roles     = $this->renderRolesOption(Role::query()->orderBy('id', 'asc')->get(['id', 'name']));

        if ($this->routeName === 'edit-pengguna') {
            $this->user    = $pengguna;
            $this->f_name  = $pengguna->nama;
            $this->f_email = $pengguna->email;
            $this->f_bpsid = $pengguna->bpsid;
            $this->f_unit  = $pengguna->kode_satker_id;
            $this->f_role  = $pengguna->roles[0]->id;
        }
    }

    public function storeData(MPenggunaRepository $penggunaRepository)
    {
        $result = $this->routeName === 'tambah-pengguna'
            ? $penggunaRepository->store($this)
            : $penggunaRepository->update($this);

        session()->flash('messages', $result);

        return $this->callbackUrl('/pengaturan/pengguna');
    }
}
