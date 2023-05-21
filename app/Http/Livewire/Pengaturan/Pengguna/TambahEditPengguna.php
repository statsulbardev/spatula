<?php

namespace App\Http\Livewire\Pengaturan\Pengguna;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\HasModelProcess;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditPengguna extends Component
{
    use HasModelProcess, HasRedirectUrl, HasRenderOption;

    public m_pengguna $pengguna;
    public string $routeName;
    public string $units;
    public string $f_password;

    public function render() : View
    {
        return view('livewire.pengaturan.pengguna.tambah-edit-pengguna')
            -> layout('layouts.app');
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->pengguna  = new m_pengguna();
        $this->routeName = Route::currentRouteName();
        $this->units     = $this->renderOption(
                                m_satker::get(['kode_satker', 'nama'])
                                -> map(function($item) { return [0 => $item->kode_satker, 1 => $item->nama];})
                                -> toArray()
                            );

        if ($this->routeName === 'edit-pengguna') $this->pengguna = $pengguna;
    }

    public function submitData()
    {
        $this->emit('saved');

        $this->validate();

        $result = $this->routeName === 'tambah-pengguna'
                    ? $this->massAssignment(
                            $this->pengguna,
                            [
                                'nama'           => $this->pengguna->nama,
                                'username'       => explode('@', $this->pengguna->email)[0],
                                'email'          => $this->pengguna->email,
                                'password'       => bcrypt($this->f_password),
                                'bpsid'          => $this->pengguna->bpsid,
                                'kode_satker_id' => $this->pengguna->kode_satker_id,
                                'is_petugas'     => $this->pengguna->is_petugas
                            ],
                            'tambah'
                        )
                    : $this->massAssignment(
                        $this->pengguna,
                        [
                            'nama'           => $this->pengguna->nama,
                            'username'       => explode('@', $this->pengguna->email)[0],
                            'email'          => $this->pengguna->email,
                            'password'       => empty($this->f_password) ? $this->pengguna->getOriginal('password') : bcrypt($this->f_password),
                            'bpsid'          => $this->pengguna->bpsid,
                            'kode_satker_id' => $this->pengguna->kode_satker_id,
                            'is_petugas'     => $this->pengguna->is_petugas
                        ],
                        'edit'
                    );

        session()->flash('messages', $result);

        $this->callbackUrl('/pengaturan/pengguna');
    }

    protected function rules() : array
    {
        $password = $this->routeName === 'tambah-pengguna'
                    ? 'required|min:8'
                    : 'nullable|min:8';

        return [
            'pengguna.nama'           => 'required|min:3|max:100',
            'pengguna.email'          => 'required|email:rfc|unique:m_pengguna,email,' . $this->pengguna->id,
            'pengguna.bpsid'          => 'required|digits:9',
            'pengguna.kode_satker_id' => 'required',
            'pengguna.is_petugas'     => 'required',
            'f_password'              => $password
        ];
    }

    protected $messages = [
        'pengguna.nama.required'           => 'Nama pengguna tidak boleh kosong',
        'pengguna.nama.min'                => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
        'pengguna.nama.max'                => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
        'pengguna.email.required'          => 'Email tidak boleh kosong',
        'pengguna.email.email'             => 'Format email tidak benar',
        'pengguna.email.unique'            => 'Email yang diiskan sudah pernah terdaftar',
        'pengguna.bpsid.required'          => 'NIP BPS tidak boleh kosong',
        'pengguna.bpsid.digits'            => 'NIP BPS harus terdiri dari 9 nomor',
        'pengguna.kode_satker_id.required' => 'Unit kerja harus terpilih salah satu',
        'pengguna.is_petugas.required'     => 'Jenis petugas harus terpilih salah satu',
        'f_password.required'              => 'Password tidak boleh kosong',
        'f_password.min'                   => 'Password minimal 8 karakter'
    ];
}
