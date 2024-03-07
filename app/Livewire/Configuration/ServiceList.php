<?php

namespace App\Livewire\Configuration;

use App\Models\m_layanan;
use App\Traits\HasModelProcess;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceList extends Component
{
    use HasModelProcess, WithPagination;

    /** @props */
    public m_layanan $layanan;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('daftar-layanan'),
            'label' => 'Daftar Layanan'
        ];
    }

    public function render() : View
    {
        return view('livewire.configuration.service-list', [
            'services' => m_layanan::search($this->searchKeyword)
                            -> orderBy('id', 'asc')
                            -> paginate($this->numberOfPagination)
        ])->layout('layouts.app');
    }

    // reset pagination
    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_layanan $layanan)
    {
        $this->layanan = $layanan;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->layanan);

        $this->dispatch('notification', message: $result);
    }
}
