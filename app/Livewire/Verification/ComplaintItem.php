<?php

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use Livewire\Component;

class ComplaintItem extends Component
{
    public $complaint;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route'  => route('daftar-pj-pengaduan'),
            'label'  => 'Daftar Verifikasi',
        ];
    }

    /** @computed property : firstBreadcrumb */
    public function getFirstBreadcrumbProperty() : array
    {
        return [
            'route' => route('detail-pj-pengaduan', ['customer' => $this->complaint->id]),
            'label' => 'Verifikasi Pengaduan',
        ];
    }

    /** @computed property : secondBreadcrumb */
    public function getSecondBreadcrumbProperty() : string
    {
        return $this->complaint->nama_konsumen;
    }

    public function render()
    {
        return view('livewire.verification.complaint-item')
            -> layout('layouts.app');
    }

    public function mount(d_penilaian $customer)
    {
        $this->complaint = $customer;
    }
}
