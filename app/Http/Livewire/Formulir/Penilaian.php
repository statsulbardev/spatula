<?php

namespace App\Http\Livewire\Formulir;

use App\Models\m_layanan;
use App\Models\m_pengguna;
use Livewire\Component;

class Penilaian extends Component
{
    public $officers;
    public $services;

    public $f_nama;
    public $f_email;
    public $f_notelpwhatsapp;
    public $f_layanan;
    public $f_ratinglayanan;
    public $f_petugas;
    public $f_ratingpetugas;
    public $f_saranpengaduan;

    public function render()
    {
        return view('livewire.formulir.penilaian');
    }

    public function mount()
    {
        $services = m_layanan::get();
        $officers = m_pengguna::role('operator')->orderBy('aktif', 'desc')->get();

        $this->services = $this->renderServiceOption($services);
        $this->officers = $this->renderOfficerOption($officers);
    }

    private function renderServiceOption($queryResult) : string
    {
        $result = null;

        foreach($queryResult as $item)
            $result .= "<option value=" . $item->id . ">" . $item->nama_layanan . "</option>";

        return $result;
    }

    private function renderOfficerOption($queryResult) : string
    {
        $result = null;

        foreach($queryResult as $item)
            $result .= "<option value=" . $item->id . ">" . $item->nama . "</option>";

        return $result;
    }
}
