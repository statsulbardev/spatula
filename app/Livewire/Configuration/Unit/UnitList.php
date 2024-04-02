<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\Unit;

use App\Models\m_satker;
use App\Traits\HasModelProcess;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class UnitList extends Component
{
    use HasModelProcess, WithPagination;

    /** @props */
    public m_satker $satker;
    public int $numberOfPagination = 10;
    public ?string $searchKeyword = null;

    public string $pageTitle = "Daftar Satuan Kerja";

    public function render(): View
    {
        return view('livewire.configuration.unit.unit-list', [
            'offices' => m_satker::search($this->searchKeyword)
                            -> orderBy('kode_satker', 'asc')
                            -> paginate($this->numberOfPagination)
        ])->title($this->pageTitle);
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_satker $satker)
    {
        $this->satker = $satker;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->satker);

        $this->dispatch('notification', message: $result);
    }
}
