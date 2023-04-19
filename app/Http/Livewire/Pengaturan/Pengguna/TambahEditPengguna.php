<?php

namespace App\Http\Livewire\Pengaturan\Pengguna;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\MPenggunaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;
use Spatie\Permission\Models\Role;

class TambahEditPengguna extends Component
{
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
        $this->roles     = $this->renderRolesOption(Role::query()->orderBy('id', 'asc')->get('name'));

        if ($this->routeName === 'edit-pengguna') {
            $this->user     = $pengguna;
            $this->f_name     = $this->user->nama;
            $this->f_email    = $this->user->email;
            $this->f_bpsid    = $this->user->bpsid;
            $this->f_unit     = $this->user->satker->nama;
        }
    }

    public function storeData(MPenggunaRepository $penggunaRepository) : Redirector
    {
        $result = $penggunaRepository->store($this);

        session()->flash('message', $result);

        return $this->callbackUrl();
    }

    // Perlu dicari cara $item->nama_kolom otomatis sesuai hasil query
    private function renderUnitsOption($queryResult) : String
    {
        $result = null;

        foreach($queryResult as $item)
            $result .= "<option value=" . $item->id . ">" . $item->nama . "</option>";

        return $result;
    }

    private function renderRolesOption($queryResult) : String
    {
        $result = null;

        foreach($queryResult as $item)
            $result .= "<option value=" . $item->name . ">" . ucwords(str_replace("-", " ", $item->name)) . "</option>";

        return $result;
    }

    private function callbackUrl() : Redirector
    {
        return redirect(env('APP_URL') . '/pengaturan/pengguna');
    }
}
