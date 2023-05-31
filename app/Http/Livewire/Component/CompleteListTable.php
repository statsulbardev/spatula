<?php

namespace App\Http\Livewire\Component;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompleteListTable extends Component
{
    use UnitCode, WithPagination;

    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    public function render() : View
    {
        return view('livewire.component.complete-list-table', [
            'dones' => $this->retrieveData()
        ]);
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    private function retrieveData()
    {
        $result = auth()->user()->hasRole('superadmin')
            ? d_penilaian::search($this->searchKeyword)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
            : d_penilaian::search($this->searchKeyword)
                -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc');

        return $result->paginate($this->numberOfPagination);
    }
}
