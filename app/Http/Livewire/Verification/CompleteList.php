<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompleteList extends Component
{
    use UnitCode, WithPagination;

    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    public function render() : View
    {
        return view('livewire.verification.complete-list', [
            'dones' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    private function retrieveData() : Paginator
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
