<?php

namespace App\Http\Livewire\Verification;

use App\Models\d_penilaian;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CompleteList extends Component
{
    use WithPagination;

    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('daftar-selesai'),
            'label' => 'Hasil Verifikasi'
        ];
    }

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

    private function retrieveData()
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return d_penilaian::search($this->searchKeyword)
                -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                    $query->where('kode_satker_id', $user_unit_code);
                })
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
                -> paginate($this->numberOfPagination);
    }
}
