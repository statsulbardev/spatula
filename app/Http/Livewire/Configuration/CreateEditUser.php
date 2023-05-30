<?php

namespace App\Http\Livewire\Configuration;

use App\Http\Requests\StoreUserRequest;
use App\Models\m_pengguna;
use App\Repositories\UserRepository;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class CreateEditUser extends Component
{
    use HasRedirectUrl, HasRenderOption;

    public m_pengguna $pengguna;
    public string $routeName;
    public string $selectedRole;
    protected StoreUserRequest $ruleValidation;

    // Form Data
    public $f_nama;
    public $f_email;
    public $f_password;
    public $f_nip;
    public $f_petugas;
    public $f_role;
    public $f_unit;

    // Computed Properties : units
    public function getUnitsProperty(UserRepository $userRepository) : string
    {
        return $this->renderOption($userRepository->retrieveUnits());
    }

    // Computed Property : role
    public function getRolesProperty(UserRepository $userRepository) : string
    {
        return $this->renderOption($userRepository->retrieveRoles());
    }

    public function boot()
    {
        $this->ruleValidation = new StoreUserRequest();
    }

    public function render() : View
    {
        return view('livewire.configuration.create-edit-user')
            -> layout('layouts.app');
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->routeName    = Route::currentRouteName();

        if ($this->routeName === 'edit-pengguna') {
            $this->pengguna     = $pengguna;
            $this->f_nama       = $pengguna->nama;
            $this->f_email      = $pengguna->email;
            $this->f_nip        = $pengguna->bpsid;
            $this->f_petugas    = $pengguna->is_petugas;
            $this->f_role       = $this->rolesToArray();
            $this->f_unit       = $pengguna->kode_satker_id;
            $this->selectedRole = json_encode($this->rolesToArray());
        }
    }

    public function submitData(UserRepository $userRepository)
    {
        $this->emit('saved');

        $this->validate();

        $result = $this->routeName === 'tambah-pengguna'
                ? $userRepository->save($this)
                : $userRepository->update($this);

        session()->flash('messages', $result);

        $this->callbackUrl('/pengaturan/pengguna');
    }

    protected function rules() : array
    {
        return ($this->ruleValidation)->rules();
    }

    protected function messages() : array
    {
        return ($this->ruleValidation)->messages();
    }

    private function rolesToArray() : array
    {
        return
            array_column(
                $this->pengguna->roles
                    -> map(function($item) {
                        return ['name' => $item->name];
                    })
                -> toArray(),
                'name'
            );
    }
}
