<?php

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use Livewire\Component;

class CompleteItem extends Component
{
    public $done;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('daftar-selesai'),
            'label' => 'Hasil Verifikasi'
        ];
    }

    /** @computed property : firstBreadcrumb */
    public function getFirstBreadcrumbProperty() : array
    {
        return [
            'route' => route('detail-selesai', request()->route()->originalParameters()),
            'label' => request()->route()->parameters()['customer']['nama_konsumen']
        ];
    }

    public function render()
    {
        return view('livewire.verification.complete-item')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->done = $customer;
    }
}
