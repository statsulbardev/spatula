<?php

namespace App\Http\Livewire\Report;

use App\Models\d_penilaian;
use App\Traits\HasReportProperty;
use App\Traits\UnitCode;
use Livewire\Component;
use Livewire\WithPagination;

class Daily extends Component
{
    use HasReportProperty, UnitCode, WithPagination;

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

    public function render()
    {
        return view('livewire.report.daily', [
            'dailyReport' => isset($this->selectedYear)
                                ? $this->updatedSelectedYear()
                                : $this->retrieveData()
        ]) -> layout('layouts.app');
    }

    public function updatedSelectedYear()
    {
        return d_penilaian::with(['petugas', 'layanan'])
                -> whereYear('created_at', '=', $this->selectedYear)
                -> whereMonth('created_at', '=', $this->selectedMonth)
                -> where('selesai', 1)
                -> paginate($this->numberOfPagination);
    }

    public function resetData()
    {
        $this->reset();

        $this->retrieveData();
    }

    private function retrieveData()
    {
        $result = auth()->user()->hasRole('superadmin')
            ? d_penilaian::with(['petugas', 'layanan'])->where('selesai', 1)->orderBy('tanggal_selesai', 'desc')
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 1)
                         ->orderBy('created_at', 'desc');

        return $result->paginate($this->numberOfPagination);
    }
}
