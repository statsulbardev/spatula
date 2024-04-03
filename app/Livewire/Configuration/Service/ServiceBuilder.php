<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\Service;

use App\Livewire\Forms\ServiceForm;
use App\Models\m_layanan;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ServiceBuilder extends Component
{
    use HasRedirectUrl;

    public ServiceForm $form;

    /** @props */
    public m_layanan $layanan;

    public string $routeName;

    public string $pageTitle;

    public function render(): View
    {
        return view('livewire.configuration.service.service-builder')
            ->layout('components.layouts.app')
            ->title($this->pageTitle);
    }

    public function mount(m_layanan $layanan)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'service.edit') {
            $this->layanan           = $layanan;
            $this->form->f_kode      = $layanan->kode_layanan;
            $this->form->f_nama      = $layanan->nama_layanan;
            $this->form->f_deskripsi = $layanan->deskripsi;
            $this->form->f_metode    = $layanan->metode;
            $this->pageTitle   = "Edit Informasi Layanan " . $layanan->nama_layanan;
        } else {
            $this->pageTitle = "Master Layanan Baru";
        }
    }

    public function submitData()
    {
        $this->dispatch('validate');

        $result = $this->routeName === 'service.create'
                ? $this->form->save()
                : $this->form->update($this->layanan);


        $this->dispatch('notification', message: $result);

        return $this->redirect(route('service.index'), navigate: true);
    }
}
