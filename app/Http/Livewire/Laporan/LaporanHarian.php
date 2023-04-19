<?php

namespace App\Http\Livewire\Laporan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanHarian extends Component
{
    use UnitCode, WithPagination;

    public $dailyReport;
    public $years;
    public $selectedMonth;
    public $selectedYear;

    public function render()
    {
        return view('livewire.laporan.laporan-harian')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->getYears();

        $this->initData();
    }

    public function updatedSelectedYear()
    {
        $this->dailyReport = d_penilaian::whereYear('created_at', '=', $this->selectedYear)
                ->whereMonth('created_at', '=', $this->selectedMonth)
                ->where('selesai', 1)
                ->get();
    }

    public function resetData()
    {
        $this->initData();
    }

    private function initData()
    {
        $this->dailyReport = Auth::user()->hasRole('superadmin')
            ? d_penilaian::where('selesai', 1)->orderBy('created_at', 'desc')->get()
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 1)
                         ->orderBy('created_at', 'desc')
                         ->get();
    }

    private function getYears()
    {
        $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
        $this->years  = $result->pluck('year');
    }
}
