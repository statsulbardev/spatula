<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSatker extends Component
{
    use WithPagination;

    public $offices;

    public function render() : View
    {
        return view('livewire.pengaturan.satker.daftar-satker')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->offices = $this->getAllSatker();
    }

    private function getAllSatker() : Collection
    {
        $result = m_satker::get([
            'id',
            'kode_satker',
            'nama',
            'alamat',
            'web',
            'telepon'
        ]);

        return $result;
    }
}
