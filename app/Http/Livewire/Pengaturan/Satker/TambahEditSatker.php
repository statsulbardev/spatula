<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use App\Traits\HasRedirectUrl;
use App\Traits\HasRenderOption;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditSatker extends Component
{
    use HasRedirectUrl, HasRenderOption;

    public m_satker $satker;
    public string $routeName;
    public string $levels;
    public string $notification;

    public function render() : View
    {
        return view('livewire.pengaturan.satker.tambah-edit-satker')
            -> layout('layouts.app');
    }

    public function mount(m_satker $satker)
    {
        $this->satker    = new m_satker();
        $this->routeName = Route::currentRouteName();
        $this->levels    = $this->renderLevelOption();

        if ($this->routeName === 'edit-satker') $this->satker = $satker;
    }

    public function submitData()
    {
        // Event for error message notification in blade.
        $this->emit('saved');

        // Validate the field.
        $this->validate();

        // Save data to database.
        try {
            DB::beginTransaction();

            $this->satker->save();

            $this->notification = "Informasi telah disimpan.";

            DB::commit();

        } catch(Exception $error) {

            DB::rollBack();

            Log::error($error->getMessage());

            $this->notification = "Informasi gagal disimpan.";
        }

        // Send notification to redirect page.
        session()->flash('messages', $this->notification);

        // Redirect the page.
        return $this->callbackUrl('/pengaturan/satker');
    }

    /**
     * Dynamic Rules for Validation.
     * https://laravel-livewire.com/docs/2.x/input-validation
     * @return string[]
     */
    protected function rules()
    {
        return [
            'satker.kode_satker' => 'required|unique:m_satker,kode_satker,' . $this->satker->id . '|min:4',
            'satker.nama'        => 'required|min:3',
            'satker.level'       => 'required',
            'satker.alamat'      => 'required|min:5',
            'satker.web'         => 'nullable|min:5',
            'satker.telepon'     => 'nullable|min:8|max:12'
        ];
    }

    protected $messages = [
        'satker.kode_satker.required' => 'Kode satker tidak boleh kosong',
        'satker.kode_satker.unique'   => 'Kode satker sudah digunakan sebelumnya',
        'satker.kode_satker.min'      => 'Kode satker minimum 4 karakter',
        'satker.nama.required'        => 'Nama satker tidak boleh kosong',
        'satker.nama.min'             => 'Nama satker minimum 3 karakter',
        'satker.level.required'       => 'Level satker tidak boleh kosong',
        'satker.alamat.required'      => 'Alamat satker tidak boleh kosong',
        'satker.alamat.min'           => 'Alamat satker minimum 5 karakter',
        'satker.web.min'              => 'Website satker minimum 5 karakter',
        'satker.telepon.min'          => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka',
        'satker.telepon.max'          => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka'
    ];
}
