<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class TambahEditSatker extends Component
{
    public $routeName;
    public m_satker $satker;
    public $countProperties = 5;

    protected $rules = [
        'kode_satker' => 'required|numeric|unique',
        'nama'        => 'required|alpha|min:3',
        'alamat'      => 'required|min:5',
        'web'         => 'nullable|min:5',
        'telepon'     => 'nullable|numeric|digits:12'
    ];

    protected $messages = [];

    public function render() : View
    {
        return view('livewire.pengaturan.satker.tambah-edit-satker')
            -> layout('layouts.app');
    }

    public function mount(m_satker $satker)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'edit-satker') $this->satker = $satker;
    }

    public function storeData()
    {
        $this->validate();
    }


}
