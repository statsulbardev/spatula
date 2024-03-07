<?php

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use App\Traits\HasModelProcess;
use App\Traits\HasInitialProperty;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ComplaintResponsibleList extends Component
{
    use HasModelProcess, HasInitialProperty, WithPagination;

    /** @props */
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty(): array
    {
        return [
            'route' => route('daftar-pj-pengaduan'),
            'label' => 'Daftar Verifikasi'
        ];
    }

    /** @computed property : suggestions */
    public function getSuggestionsProperty(): array
    {
        return $this->initSuggestionsOption();
    }

    /** @computed property : colorSuggestions */
    public function getColorSuggestionsProperty(): array
    {
        return $this->initColorSuggestionsOption();
    }

    public function render(): View
    {
        return view('livewire.verification.complaint-responsible-list', [
            'complaints' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function finalize(d_penilaian $penilaian)
    {
        $result = $this->customUpdate($penilaian, [
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        $this->dispatch('notification', message: $result);
    }

    private function retrieveData(): Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_role  = auth()->user()->satker->kode_satker;

        return d_penilaian::search($this->searchKeyword)
            ->query(fn ($query) => $query->with(['petugas', 'layanan']))
            ->when(!$superadmin_role, function (Builder $query, $data) use ($user_unit_role) {
                $query->where('kode_satker_id', $user_unit_role);
            })
            ->where('selesai', 0)
            ->where('is_pengaduan', 1)
            ->paginate($this->numberOfPagination);
    }
}
