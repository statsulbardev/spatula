<?php

namespace App\Http\Livewire\Pengaturan\Layanan;

use App\Models\m_layanan;
use App\Traits\HasModelProcess;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditLayanan extends Component
{
    use HasModelProcess, HasRedirectUrl;

    public m_layanan $layanan;
    public string $routeName;

    public function render() : View
    {
        return view('livewire.pengaturan.layanan.tambah-edit-layanan')
            -> layout('layouts.app');
    }

    public function mount(m_layanan $layanan)
    {
        $this->layanan   = new m_layanan();
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'edit-layanan') $this->layanan = $layanan;
    }

    public function submitData()
    {
        $this->emit('saved');

        $this->validate();

        $result = $this->save($this->layanan);

        session()->flash('messages', $result);

        $this->callbackUrl('/pengaturan/layanan');
    }

    /**
     * Dynamic rules for validation
     * https://laravel-livewire.com/docs/2.x/input-validation
     * @return string[]
     */
    protected function rules() : array
    {
        return [
            'layanan.kode_layanan' => 'required|unique:m_layanan,kode_layanan,' . $this->layanan->id,
            'layanan.nama_layanan' => 'required|min:5',
            'layanan.metode'       => 'required',
            'layanan.deskripsi'    => 'nullable|min:5'
        ];
    }

    protected $messages = [
        'layanan.kode_layanan.required' => 'Kode layanan tidak boleh kosong',
        'layanan.kode_layanan.unique'   => 'Kode layanan sudah digunakan sebelumnya',
        'layanan.nama_layanan.required' => 'Nama layanan tidak boleh kosong',
        'layanan.nama_layanan.min'      => 'Nama layanan minimum 5 karakter',
        'layanan.metode.required'       => 'Metode layanan harus terisi',
        'layanan.deskripsi.min'         => 'Deskripsi layanan minimal 5 karakter'
    ];
}
