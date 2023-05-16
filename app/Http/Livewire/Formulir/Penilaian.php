<?php

namespace App\Http\Livewire\Formulir;

use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\PenilaianRepository;
use App\Traits\HasRenderOption;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;
use Livewire\Component;

class Penilaian extends Component
{
    use HasRenderOption;
    
    public $officers;
    public $services;
    public $units;

    public $f_nama;
    public $f_email;
    public $f_notelpwhatsapp;
    public $f_layanan;
    public $f_ratinglayanan;
    public $f_petugas;
    public $f_ratingpetugas;
    public $f_saranpengaduan;
    public $f_unit;

    // Rule Validasi Form
    protected $rules = [
        'f_unit'           => 'required',
        'f_nama'           => 'required|min:4|max:30',
        'f_email'          => 'nullable|email:rfc,dns',
        'f_notelpwhatsapp' => 'required|numeric',
        'f_layanan'        => 'required',
        'f_ratinglayanan'  => 'required',
        'f_saranpengaduan' => 'required|min:4'
    ];

    // Pesan Error Validasi Form
    protected $messages = [
        'f_nama.required'           => 'Nama lengkap tidak boleh kosong',
        'f_nama.min'                => 'Nama lengkap min. 4 karakter',
        'f_nama.max'                => 'Nama lengkap maks. 30 karakter',
        'f_email.email'             => 'Alamat email tidak valid',
        'f_unit'                    => 'Unit kerja minimal terpilih salah satu',
        'f_notelpwhatsapp.required' => 'Nomor telp/whatsapp tidak boleh kosong',
        'f_notelpwhatsapp.numeric'  => 'Nomor telp/whatsapp hanya boleh angka',
        'f_layanan.required'        => 'Jenis Layanan minimal terpilih salah satu',
        'f_ratinglayanan.required'  => 'Rating layanan harus terpilih salah satu',
        'f_saranpengaduan.required' => 'Saran Pengaduan tidak boleh kosong',
        'f_saranpengaduan.min'      => 'Saran Pengaduan minimal terisi 4 karakter'
    ];

    /**
     * Render Komponen Penilaian Customer
     * @return View
     * @throws BindingResolutionException
     */
    public function render() : View
    {
        return view('livewire.formulir.penilaian')
            -> layout('layouts.evaluation');
    }

    public function mount()
    {
        $this->services = m_layanan::get();
        $this->units    = m_satker::get();
        $officers       = m_pengguna::role('operator')->orderBy('aktif', 'desc')->get();

        $this->officers = $this->renderOfficerOption($officers);
    }

    public function storeData(PenilaianRepository $penilaianRepository)
    {
        $this->emit('saved');

        $this->validate();

        $result = $penilaianRepository->store($this);

        session()->flash('messages', $result);

        return redirect(env('APP_URL') . '/penilaian');
    }

    public function resetData()
    {
        $this->resetErrorBag();

        $this->resetExcept(['officers', 'services', 'units']);
    }

    public function updatedFLayanan()
    {
        $temp = explode('-', $this->f_layanan)[1];

        $this->dispatchBrowserEvent('contentChanged');

        if ($temp == 2)
            $this->reset(['f_petugas', 'f_ratingpetugas']);
    }


    private function renderOfficerOption($queryResult) : string
    {
        $result = null;

        foreach($queryResult as $item)
            $result .= "<option value=" . $item->id . ">" . $item->nama . "</option>";

        return $result;
    }
}
