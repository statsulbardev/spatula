<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\User;

use App\Livewire\Forms\UserForm;
use App\Models\m_pengguna;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserBuilder extends Component
{
    use HasRedirectUrl, HasRenderOption;

    public UserForm $form;

    public m_pengguna $pengguna;

    public string $routeName;

    public string $title;

    /** @computed property : units */
    public function getUnitsProperty() : string
    {
        return $this->renderOption($this->form->retrieveUnits());
    }

    public function render(): View
    {
        return view('livewire.configuration.user.user-builder')->title($this->title);
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'user.edit') {
            $this->pengguna        = $pengguna;
            $this->form->f_nama    = $pengguna->nama;
            $this->form->f_email   = $pengguna->email;
            $this->form->f_nip     = $pengguna->bpsid;
            $this->form->f_petugas = $pengguna->is_petugas;
            $this->form->f_role    = $this->rolesToArray();
            $this->form->f_unit    = $pengguna->kode_satker_id;

            $this->title           = "Edit Pengguna " . $pengguna->nama;
        } else {
            $this->title = "Pengguna Baru";
        }
    }

    public function submitData()
    {
        $this->dispatch('validate');

        $result = $this->routeName === 'user.create'
                ? $this->form->save()
                : $this->form->update($this->pengguna);

        $this->dispatch('notification', message: $result);

        return $this->redirectRoute('user.index', navigate: true);
    }

    private function rolesToArray(): array
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
