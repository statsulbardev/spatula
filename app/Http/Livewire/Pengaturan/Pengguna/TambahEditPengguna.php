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
    public $user;
    public $units;

    public function render() : View
    {
        return view('livewire.pengaturan.pengguna.tambah-edit-pengguna')
            -> layout('layouts.app');
    }

    public function mount(m_pengguna $pengguna)
    {
        $this->pengguna  = new m_pengguna();
        $this->routeName = Route::currentRouteName();
        $this->units     = $this->renderUnitsOption(m_satker::get(['id', 'nama']));

        if ($this->routeName === 'edit-pengguna') $this->pengguna = $pengguna;
    }

    public function submitData()
    {
        $this->emit('saved');

        $this->validate();

        dd(isset($this->pengguna->password));
        // $result = isset($this->pengguna->password)
        //     ? 'jalan'
        //     : $this->save($this->pengguna->exclude(['password']));

        session()->flash('messages', $result);

        return $this->callbackUrl('/pengaturan/pengguna');
    }

    protected function rules() : array
    {
        $password = $this->routeName === 'edit-pengguna'
                    ? 'nullable|min:8'
                    : 'required|min:8';

        return [
            'pengguna.nama'           => 'required|min:3|max:100',
            'pengguna.email'          => 'required|email:rfc|unique:m_pengguna,email,' . $this->pengguna->id,
            'pengguna.password'       => $password,
            'pengguna.bpsid'          => 'required|digits:9',
            'pengguna.kode_satker_id' => 'required'
        ];
    }

    protected $messages = [
        'pengguna.nama.required'     => 'Nama pengguna tidak boleh kosong',
        'pengguna.nama.min'          => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
        'pengguna.nama.max'          => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
        'pengguna.email.required'    => 'Email tidak boleh kosong',
        'pengguna.email.email'       => 'Format email tidak benar',
        'pengguna.email.unique'      => 'Email yang diiskan sudah pernah terdaftar',
        'pengguna.password.required' => 'Password tidak boleh kosong',
        'pengguna.password.min'      => 'Password minimal 8 karakter',
        'pengguna.bpsid.required'    => 'NIP BPS tidak boleh kosong',
        'pengguna.bpsid.digits'      => 'NIP BPS harus terdiri dari 9 nomor',
        'pengguna.kode_satker.id'    => 'Unit kerja harus terpilih salah satu'
    ];
}
