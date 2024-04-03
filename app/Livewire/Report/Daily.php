<?php

declare(strict_types=1);

namespace App\Livewire\Report;

use App\Models\d_penilaian;
use App\Traits\HasInitialProperty;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Daily extends Component
{
    use HasInitialProperty, WithPagination;

    public int $numberOfPagination = 20;

    /** @props */
    public $selectedMonth;
    public $selectedYear;

    /** @computed property : months */
    public function getMonthsProperty()
    {
        return $this->initMonthsOption();
    }

    /** @computed property : years */
    public function getYearsProperty()
    {
        return $this->initYearsOption();
    }

    /** @computed property : suggestions */
    public function getSuggestionsProperty()
    {
        return $this->initSuggestionsOption();
    }

    #[Title('Laporan Harian')]
    public function render(): View
    {
        return view('livewire.report.daily', ['dailyReport' => $this->retrieveData()])
            ->layout('components.layouts.app');
    }

    public function resetData()
    {
        $this->reset();
        $this->dispatch('laporan-harian-daily-reset-filter');
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
        if($this->selectedYear){
            $return_data_query->whereYear('created_at', $this->selectedYear);
        }
        if($this->selectedMonth){
            $return_data_query->whereMonth('created_at', $this->selectedMonth);
        }
        $return_data_query->where('selesai', 1)
            ->orderBy('tanggal_selesai', 'desc');

        return $return_data_query->paginate($this->numberOfPagination);
    }
}
