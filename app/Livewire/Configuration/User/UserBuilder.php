<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\User;

use App\Http\Requests\StoreUserRequest;
use App\Models\m_pengguna;
use App\Repositories\UserRepository;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserBuilder extends Component
{
    use HasRedirectUrl, HasRenderOption;

    /** @props */
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

    /** @computed property : units */
    public function getUnitsProperty(UserRepository $userRepository) : string
    {
        return $this->renderOption($userRepository->retrieveUnits());
    }

    /** @computed property : role */
    public function getRolesProperty(UserRepository $userRepository) : string
    {
        return $this->renderOption($userRepository->retrieveRoles());
    }

    public function render(): View
    {
        return view('livewire.configuration.user.user-builder');
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->routeName      = Route::currentRouteName();

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
        $this->dispatch('saved');

        $this->ruleValidation = new StoreUserRequest();
        $this->validate();

        $result = $this->routeName === 'tambah-pengguna'
                ? $userRepository->save($this)
                : $userRepository->update($this);

        $this->dispatch('notification', message: $result);

        return $this->redirectRoute('daftar-pengguna', navigate: true);
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
