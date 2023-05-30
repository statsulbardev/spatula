<?php

namespace App\Http\Livewire\Configuration;

use App\Models\m_satker;
use App\Traits\HasModelProcess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class UnitList extends Component
{
    use HasModelProcess, WithPagination;

    public m_satker $satker;
    public int $numberOfPagination = 10;
    public ?string $searchKeyword = null;

    public function render() : View
    {
        return view('livewire.configuration.unit-list', [
            'offices' => m_satker::search($this->searchKeyword)
                            -> orderBy('kode_satker', 'asc')
                            -> paginate($this->numberOfPagination)
        ])->layout('layouts.app');
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

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }
}
