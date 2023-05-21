<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use App\Traits\HasModelProcess;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditSatker extends Component
{
    use HasModelProcess, HasRedirectUrl;

    public m_satker $satker;
    public string $routeName;

    public function render() : View
    {
        return view('livewire.pengaturan.satker.tambah-edit-satker')
            -> layout('layouts.app');
    }

    public function mount(m_satker $satker)
    {
        $this->satker    = new m_satker();
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'edit-satker') $this->satker = $satker;
    }

    public function submitData()
    {
        // Event for error message notification in blade.
        $this->emit('saved');

        // Validate the field.
        $this->validate();

        // Save data to database.
        $result = $this->save($this->satker);

        // Send notification to redirect page.
        session()->flash('messages', $result);

        // Redirect the page.
        $this->callbackUrl('/pengaturan/satker');
    }

    /**
     * Dynamic Rules for Validation.
     * https://laravel-livewire.com/docs/2.x/input-validation
     * @return string[]
     */
    protected function rules() : array
    {
        return [
            'satker.kode_satker' => 'required|unique:m_satker,kode_satker,' . $this->satker->id . '|min:4',
            'satker.nama'        => 'required|min:3|max:100',
            'satker.level'       => 'required',
            'satker.alamat'      => 'required|min:5|max:191',
            'satker.web'         => 'nullable|min:5|max:50',
            'satker.telepon'     => 'nullable|min:8|max:12'
        ];
    }

    protected $messages = [
        'satker.kode_satker.required' => 'Kode satker tidak boleh kosong',
        'satker.kode_satker.unique'   => 'Kode satker sudah digunakan sebelumnya',
        'satker.kode_satker.min'      => 'Kode satker minimum 4 karakter',
        'satker.nama.required'        => 'Nama satker tidak boleh kosong',
        'satker.nama.min'             => 'Nama satker minimum 3 karakter',
        'satker.nama.max'             => 'Nama satker maksimum 100 karakter',
        'satker.level.required'       => 'Level satker tidak boleh kosong',
        'satker.alamat.required'      => 'Alamat satker tidak boleh kosong',
        'satker.alamat.min'           => 'Alamat satker minimum 5 karakter',
        'satker.alamat.max'           => 'Alamat satker maksimum 191 karakter',
        'satker.web.min'              => 'Website satker minimum 5 karakter',
        'satker.web.max'              => 'Website satker maksimum 50 karakter',
        'satker.telepon.min'          => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka',
        'satker.telepon.max'          => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka'
    ];
}
