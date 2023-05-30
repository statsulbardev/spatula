<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use App\Traits\HasModelProcess;
use App\Traits\UnitCode;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceResponsibleList extends Component
{
    use HasModelProcess, UnitCode, WithPagination;

    public d_penilaian $penilaian;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    public function render()
    {
        return view('livewire.verification.service-responsible-list', [
            'services' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function finalizeServiceItem(d_penilaian $penilaian)
    {
        $result = $this->customUpdate($penilaian, [
                    'selesai' => 1,
                    'tanggal_selesai' => Carbon::now()
                ]);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }

    public function deleteItem(d_penilaian $penilaian)
    {
        $this->penilaian = $penilaian;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->penilaian);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }

    private function retrieveData() : Paginator
    {
        $result = auth()->user()->hasRole('superadmin')
            ? d_penilaian::search($this->searchKeyword)
                        -> query(fn ($query) => $query->with(['petugas', 'layanan']))
                        -> where('selesai', 0)
                        -> orderBy('created_at', 'desc')
            : d_penilaian::search($this->searchKeyword)
                        -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                        -> where('selesai', 0)
                        -> orderBy('created_at', 'desc');

        return $result->paginate($this->numberOfPagination);
    }
}
