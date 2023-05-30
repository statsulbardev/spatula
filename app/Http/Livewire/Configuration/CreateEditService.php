<?php

namespace App\Http\Livewire\Configuration;

use App\Http\Requests\StoreServiceRequest;
use App\Models\m_layanan;
use App\Repositories\ServiceRepository;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class CreateEditService extends Component
{
    use HasRedirectUrl;

    public m_layanan $layanan;
    public string $routeName;
    protected StoreServiceRequest $ruleValidation;

    // Form Data
    public $f_kode;
    public $f_nama;
    public $f_deskripsi;
    public $f_metode;

    public function boot()
    {
        $this->ruleValidation = new StoreServiceRequest();
    }

    public function render() : View
    {
        return view('livewire.configuration.create-edit-service')
            -> layout('layouts.app');
    }

    public function mount(m_layanan $layanan)
    {
        $this->routeName = Route::currentRouteName();

        if ($this->routeName === 'edit-layanan') {
            $this->layanan     = $layanan;
            $this->f_kode      = $layanan->kode_layanan;
            $this->f_nama      = $layanan->nama_layanan;
            $this->f_deskripsi = $layanan->deskripsi;
            $this->f_metode    = $layanan->metode;
        }
    }

    public function submitData(ServiceRepository $serviceRepository)
    {
        $this->emit('saved');

        $this->validate();

        $result = $this->routeName === 'tambah-layanan'
                ? $serviceRepository->save($this)
                : $serviceRepository->update($this);

        session()->flash('messages', $result);

        $this->callbackUrl('/pengaturan/layanan');
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
