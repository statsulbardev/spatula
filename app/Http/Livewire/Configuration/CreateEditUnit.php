<?php

namespace App\Http\Livewire\Configuration;

use App\Http\Requests\StoreUnitRequest;
use App\Models\m_satker;
use App\Repositories\Interfaces\ConfigurationInterface;
use App\Traits\HasRedirectUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class CreateEditUnit extends Component
{
    use HasRedirectUrl;

    /** protected props */
    protected ConfigurationInterface $unitRepository;
    protected StoreUnitRequest $ruleValidation;

    /** @props */
    public m_satker $satker;
    public string $routeName;

    // Form Data
    public $f_kode;
    public $f_nama;
    public $f_level;
    public $f_alamat;
    public $f_web;
    public $f_telepon;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('daftar-satker'),
            'label' => 'Daftar Satker',
        ];
    }

    /** @computed property : firstBread */
    public function getFirstBreadcrumbProperty()
    {
        if ($this->routeName === 'edit-satker')
            return [
                'route' => route('edit-satker', request()->route()->originalParameters()),
                'label' => 'Edit Satker',
            ];
    }

    /** @computed property : secondBreadcrumb */
    public function getSecondBreadcrumbProperty() : string
    {
        return $this->routeName === 'tambah-satker'
                ? 'Tambah Satker'
                : request()->route()->parameters()['satker']['nama'];
    }

    public function boot(ConfigurationInterface $unitRepository)
    {
        $this->routeName      = Route::currentRouteName();
        $this->ruleValidation = new StoreUnitRequest();
        $this->unitRepository = $unitRepository;
    }

    public function render() : View
    {
        return view('livewire.configuration.create-edit-unit')
            -> layout('layouts.app');
    }

    public function mount(m_satker $satker)
    {
        if ($this->routeName === 'edit-satker') {
            $this->satker    = $satker;
            $this->f_kode    = $satker->kode_satker;
            $this->f_nama    = $satker->nama;
            $this->f_level   = $satker->level;
            $this->f_alamat  = $satker->alamat;
            $this->f_web     = $satker->web;
            $this->f_telepon = $satker->telepon;
        }
    }

    public function submitData()
    {
        // Event for error message notification in blade.
        $this->emit('saved');

        // Validate the field.
        $this->validate();

        // Save data to database.
        $result = $this->routeName === 'tambah-satker'
                ? $this->unitRepository->save($this)
                : $this->unitRepository->update($this);

        // Send notification to redirect page.
        session()->flash('messages', $result);

        // Redirect the page.
        $this->callbackUrl('/pengaturan/satker');
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
