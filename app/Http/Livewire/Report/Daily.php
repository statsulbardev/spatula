<?php

namespace App\Http\Livewire\Report;

use App\Models\d_penilaian;
use App\Traits\HasReportProperty;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Daily extends Component
{
    use HasReportProperty, WithPagination;

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

    /** @computed proprty : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('laporan-harian'),
            'label' => 'Laporan',
        ];
    }

    /** @computed property : secondBreadcrumb */
    public function getSecondBreadcrumbProperty()
    {
        return 'Harian';
    }

    public function boot()
    {}

    public function render() : View
    {
        return view('livewire.report.daily', [
            'dailyReport' => isset($this->selectedYear)
                                ? $this->updatedSelectedYear()
                                : $this->retrieveData()
        ]) -> layout('layouts.app');
    }

    public function updatedSelectedYear()
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return d_penilaian::with(['petugas', 'layanan'])
                -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                    $query->where('kode_satker_id', $user_unit_code);
                })
                -> whereYear('created_at', '=', $this->selectedYear)
                -> whereMonth('created_at', '=', $this->selectedMonth)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
                -> paginate($this->numberOfPagination);
    }

    public function resetData()
    {
        $this->reset();

        $this->retrieveData();
    }

    private function retrieveData() : Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return d_penilaian::with(['petugas', 'layanan'])
                -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code)  {
                    $query->where('kode_satker_id', $user_unit_code);
                })
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
                -> paginate($this->numberOfPagination);
    }
}
