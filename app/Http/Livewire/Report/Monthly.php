<?php

namespace App\Http\Livewire\Report;

use App\Traits\HasReportProperty;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Monthly extends Component
{
    use HasReportProperty, WithPagination;

    /** @props */
    public $selectedYear;
    public $officerRating;
    public $serviceRating;
    public $complaintSuggestion;

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

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty() : array
    {
        return [
            'route' => route('laporan-bulanan'),
            'label' => 'Laporan'
        ];
    }

    /** @computed propery : secondBreadcrumb */
    public function getSecondBreadcrumbProperty() : string
    {
        return 'Bulanan';
    }

    public function boot()
    {
        $this->selectedYear = date("Y");

        $this->officerRating       = $this->getOfficerRating();
        $this->serviceRating       = $this->getServiceRating();
        $this->complaintSuggestion = $this->getComplaintSuggestion();
    }

    public function render()
    {
        return view("livewire.report.monthly")->layout("layouts.app");
    }

    public function updatedSelectedYear()
    {
        $this->officerRating       = $this->getOfficerRating();
        $this->serviceRating       = $this->getServiceRating();
        $this->complaintSuggestion = $this->getComplaintSuggestion();
    }

    private function getOfficerRating()
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $result = DB::table("d_penilaian")
                    -> join("m_pengguna", "d_penilaian.kode_petugas", "=", "m_pengguna.id")
                    -> selectRaw(
                            "MONTH(d_penilaian.created_at) as bulan,
                            m_pengguna.nama,
                            AVG(d_penilaian.rating_petugas) as rerata,
                            COUNT(d_penilaian.rating_petugas) as jumlah_terlayani")
                    -> whereRaw("YEAR(d_penilaian.created_at) = " . $this->selectedYear)
                    -> where("selesai", 1)
                    -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                            $query->where('d_penilaian.kode_satker_id', $user_unit_code);
                    })
                    -> groupByRaw("MONTH(d_penilaian.created_at), m_pengguna.nama")
                    -> get()
                    -> groupBy('bulan');

        $column = ["Bulan", "Nama Petugas", "Rating Rata-Rata", "Jumlah Penilaian"];

        return [$column, $result];
    }

    private function getServiceRating()
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $result = DB::table("d_penilaian")
                    -> join("m_layanan", "d_penilaian.kode_layanan", "=", "m_layanan.kode_layanan")
                    -> selectRaw(
                            "MONTH(d_penilaian.created_at) as bulan,
                            m_layanan.nama_layanan,
                            AVG(d_penilaian.rating_layanan) as rerata,
                            COUNT(d_penilaian.rating_layanan) as jumlah_terlayani")
                    -> whereRaw("YEAR(d_penilaian.created_at) = " . $this->selectedYear)
                    -> where("selesai", 1)
                    -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                            $query->where('d_penilaian.kode_satker_id', $user_unit_code);
                    })
                    -> groupByRaw("MONTH(d_penilaian.created_at), m_layanan.nama_layanan")
                    -> get()
                    -> groupBy('bulan');

        $column = ["Bulan", "Nama Layanan", "Rating Rata-Rata", "Jumlah Penilaian"];

        return [$column, $result];
    }

    private function getComplaintSuggestion()
    {
        $data = [];

        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $result = DB::table("d_penilaian")
                    -> selectRaw("MONTH(created_at) as bulan, kode_saran")
                    -> whereRaw("YEAR(created_at) = " . $this->selectedYear)
                    -> where("selesai", 1)
                    -> when(! $superadmin_role, function(Builder $query) use ($user_unit_code) {
                        $query->where('d_penilaian.kode_satker_id', $user_unit_code);
                    })
                    -> groupBy("created_at", "kode_saran")
                    -> get()
                    -> mapToGroups(function ($item, $key) {
                        return [$item->bulan => json_decode($item->kode_saran)];
                    })
                    -> all();

        foreach ($result as $index => $d) $data[$index] = $d->flatten()->countBy();

        // dd($data);

        $column = ["Bulan", "Kategori Saran Pengaduan", "Jumlah Penilaian"];

        return [$column, $data];
    }
}
