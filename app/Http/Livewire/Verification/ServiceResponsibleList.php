<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use App\Traits\HasModelProcess;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Scout\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceResponsibleList extends Component
{
    use HasModelProcess, WithPagination;

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
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return d_penilaian::search($this->searchKeyword)
                        -> query(fn ($query) => $query->with(['petugas', 'layanan']))
                        -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                            $query->where('kode_satker_id', $user_unit_code);
                        })
                        -> where('selesai', 0)
                        -> orderBy('created_at', 'desc')
                        -> paginate($this->numberOfPagination);
    }
}
