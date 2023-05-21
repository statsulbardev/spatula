<?php

namespace App\Http\Livewire\Pengaturan\Petugas;

use App\Models\m_pengguna;
use App\Traits\HasModelProcess;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditPetugas extends Component
{
    use HasModelProcess, HasRedirectUrl, HasRenderOption;

    public m_pengguna $petugas;
    public string $routeName;
    public string $roles;
    public string $officers;

    public string $f_petugas;
    public array $f_role;
    public string $selectedRole;

    public function render() : View
    {
        return view('livewire.pengaturan.petugas.tambah-edit-petugas')
            -> layout('layouts.app');
    }

    public function mount(m_pengguna $petugas)
    {
        $this->routeName = Route::currentRouteName();
        $this->officers  = $this->renderOption(
                                m_pengguna::query()
                                -> where('is_petugas', true)
                                -> get(['id', 'nama'])
                                -> map(function($item) { return [0 => $item->id, 1 => $item->nama]; })
                                -> toArray()
                            );

        $this->roles = "<option value='pj-layanan'>PJ Layanan</option>" .
                       "<option value='pj-pengaduan'>PJ Pengaduan</option>" .
                       "<option value='operator'>Operator</option>";

        if ($this->routeName === 'edit-petugas') {
            $this->petugas      = $petugas;
            $this->f_petugas    = $petugas->id;
            $this->f_role       = $this->rolesToArray();
            $this->selectedRole = json_encode($this->rolesToArray());
        }
    }

    public function submitData()
    {
        $this->emit('saved');

        $this->validate();

        $query = m_pengguna::find($this->f_petugas);

        try {
            DB::beginTransaction();

            $query->syncRoles($this->f_role);

            DB::commit();

            $result = "Informasi petugas telah diperbaharui.";
        } catch(Exception $error) {
            DB::rollBack();

            $result = "Informasi petugas gagal diperbaharui.";
        }

        session()->flash('messages', $result);

        $this->callbackUrl('/pengaturan/petugas');
    }

    protected function rules() : array
    {
        return [
            'f_petugas' => 'required',
            'f_role'    => 'required'
        ];
    }

    protected $messages = [
        'f_petugas.required' => 'Petugas harus terpilih salah satu.',
        'f_role.required'    => 'Role petugas harus terpilih salah satu'
    ];

    private function rolesToArray() : array
    {
        return array_column(
            $this->petugas->roles
                -> map(function($item) {
                    return ['name' => $item->name];
                })
            -> toArray(),
            'name');
    }
}
