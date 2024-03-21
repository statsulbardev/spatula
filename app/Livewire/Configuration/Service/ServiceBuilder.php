<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\Service;

use App\Http\Requests\StoreServiceRequest;
use App\Models\m_layanan;
use App\Repositories\ServiceRepository;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ServiceBuilder extends Component
{
    use HasRedirectUrl;

    /** protected props */
    protected StoreServiceRequest $ruleValidation;

    /** @props */
    public m_layanan $layanan;

    public string $routeName;

    public string $pageTitle;

    // Form Data
    public $f_kode;
    public $f_nama;
    public $f_deskripsi;
    public $f_metode;

    public function render(): View
    {
        return view('livewire.configuration.service.service-builder')
            -> layout('layouts.app');
    }

    public function mount(m_layanan $layanan)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'service.master.edit') {
            $this->layanan     = $layanan;
            $this->f_kode      = $layanan->kode_layanan;
            $this->f_nama      = $layanan->nama_layanan;
            $this->f_deskripsi = $layanan->deskripsi;
            $this->f_metode    = $layanan->metode;
            $this->pageTitle   = "Edit Master Layanan";
        } else {
            $this->pageTitle = "Master Layanan Baru";
        }
    }

    public function submitData(ServiceRepository $serviceRepository)
    {
        $this->dispatch('saved');

        $this->ruleValidation    = new StoreServiceRequest();
        $this->validate();

        $result = $this->routeName === 'tambah-layanan'
                ? $serviceRepository->save($this)
                : $serviceRepository->update($this);

        $this->redirectRoute('daftar-layanan', navigate: true);

        $this->dispatch('notification', message: $result);
    }

    protected function rules() : array
    {
        return ($this->ruleValidation)->rules();
    }

    protected function messages() : array
    {
        return ($this->ruleValidation)->messages();
    }
}
