<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\Unit;

use App\Http\Requests\StoreUnitRequest;
use App\Livewire\Forms\UnitForm;
use App\Models\m_satker;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class unitBuilder extends Component
{
    use HasRedirectUrl;

    public UnitForm $form;

    public m_satker $satker;

    public string $routeName;

    public string $pageTitle;

    public function mount(m_satker $satker)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'unit.edit') {
            $this->satker          = $satker;
            $this->form->f_kode    = $satker->kode_satker;
            $this->form->f_nama    = $satker->nama;
            $this->form->f_level   = $satker->level;
            $this->form->f_alamat  = $satker->alamat;
            $this->form->f_web     = $satker->web;
            $this->form->f_telepon = $satker->telepon;
            $this->pageTitle       = "Informasi satker " . $satker->nama;
        } else {
            $this->pageTitle       = "Tambah Satker Baru";
        }
    }

    public function render(): View
    {
        return view('livewire.configuration.unit.unit-builder')->title($this->pageTitle);
    }

    public function submitData()
    {
        $this->dispatch('validate');

        $result = $this->routeName === 'unit.create'
                ? $this->form->save()
                : $this->form->update($this->satker);

        $this->dispatch('notification', message: $result);

        return $this->redirectRoute('unit.index', navigate: true);
    }
}
