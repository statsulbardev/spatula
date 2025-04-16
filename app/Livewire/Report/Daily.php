<?php

declare(strict_types=1);

namespace App\Livewire\Report;

use App\Models\d_penilaian;
use App\Traits\HasInitialProperty;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Daily extends Component
{
    use HasInitialProperty, WithPagination;

    public int $numberOfPagination = 20;

    public ?string $selectedMonth = null;

    public ?string $selectedYear = null;

    #[Computed]
    public function months()
    {
        return $this->initMonthsOption();
    }

    #[Computed]
    public function years()
    {
        return $this->initYearsOption();
    }

   #[Computed]
    public function suggestions()
    {
        return $this->initSuggestionsOption();
    }

    #[Title('Laporan Harian')]
    public function render(): View
    {
        return view('livewire.report.daily', ['dailyReport' => $this->retrieveData()])
            ->layout('components.layouts.app');
    }

    public function resetData(): void
    {
        $this->reset();
    }

    private function retrieveData(): Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        $return_data_query = d_penilaian::query();
        $return_data_query->with(['petugas', 'layanan']);
        $return_data_query->when(!$superadmin_role, function ($query) use ($user_unit_code) {
            $query->where('kode_satker_id', $user_unit_code);
        });

        if ($this->selectedYear) {
            $return_data_query->whereYear('created_at', $this->selectedYear);
        }

        if ($this->selectedMonth) {
            $return_data_query->whereMonth('created_at', $this->selectedMonth);
        }

        $return_data_query->where('selesai', 1)
            ->orderBy('tanggal_selesai', 'desc');

        return $return_data_query->paginate($this->numberOfPagination);
    }
}
