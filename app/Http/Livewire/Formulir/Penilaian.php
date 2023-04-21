<?php

namespace App\Http\Livewire\Formulir;

use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\PenilaianRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Livewire\Component;

class Penilaian extends Component
{
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

    protected $rules = [
        'f_unit'           => 'required',
        'f_nama'           => 'required|max:20',
        'f_email'          => 'nullable|email:rfc,dns',
        'f_notelpwhatsapp' => 'required|numeric',
        'f_layanan'        => 'required',
        'f_ratinglayanan'  => 'required'
    ];

    protected $messages = [
        'f_nama.required' => 'Nama Lengkap Tidak Boleh Kosong',
        'f_nama.max'      => 'Nama Lengkap Maks. 20 Karakter',
        'f_email.email'   => 'Alamat email tidak valid',
        'f_unit'          => 'Unit kerja minimal terpilih salah satu'
    ];


    public function render()
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
