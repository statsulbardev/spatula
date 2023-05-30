<?php

namespace App\Http\Livewire\Report;

use App\Traits\HasReportProperty;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Monthly extends Component
{
    use HasReportProperty, UnitCode, WithPagination;

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

    public function boot()
    {
        $this->selectedYear = date('Y');
        $this->officerRating = $this->getOfficerRating(auth()->user()->hasRole('superadmin'));
        $this->serviceRating = $this->getServiceRating(auth()->user()->hasRole('superadmin'));
        $this->complaintSuggestion = $this->getComplaintSuggestion(auth()->user()->hasRole('superadmin'));
    }

    public function render()
    {
        return view('livewire.report.monthly')->layout('layouts.app');
    }

    public function updatedSelectedYear()
    {
        $this->officerRating = $this->getOfficerRating(auth()->user()->hasRole('superadmin'));
        $this->serviceRating = $this->getServiceRating(auth()->user()->hasRole('superadmin'));
        $this->complaintSuggestion = $this->getComplaintSuggestion(auth()->user()->hasRole('superadmin'));
    }

    private function getOfficerRating($role)
    {
        if ($role) {
            $result = DB::table('d_penilaian')
                        -> join('m_pengguna', 'd_penilaian.kode_petugas', '=', 'm_pengguna.id')
                        -> selectRaw('MONTH(d_penilaian.created_at) as bulan, m_pengguna.nama, AVG(d_penilaian.rating_petugas) as rerata, COUNT(d_penilaian.rating_petugas) as jumlah_terlayani')
                        -> whereRaw('YEAR(d_penilaian.created_at) = ' . $this->selectedYear)
                        -> where('selesai', 1)
                        -> groupByRaw('MONTH(d_penilaian.created_at), m_pengguna.nama')
                        -> get();
        } else {
            $result = DB::select(
                        'SELECT MONTH(a.created_at) as bulan,
                            b.nama,
                            AVG(rating_petugas) as rerata,
                            COUNT(rating_petugas) as jumlah_terlayani
                        FROM
                            d_penilaian a,
                            m_pengguna b
                        WHERE
                            a.kode_satker_id = ' . $this->getUnitCode()->kode_satker . ' AND
                            a.kode_petugas=b.id AND
                            YEAR(a.created_at) = '. $this->selectedYear .'
                        GROUP BY
                            a.kode_satker_id,
                            MONTH(a.created_at),
                            b.nama'
                    );
        }

        $column = ['Bulan', 'Nama Petugas', 'Rating Rata-Rata', 'Jumlah Penilaian'];

        return [$column, $result];
    }

    private function getServiceRating($role)
    {
        if ($role) {
            $result = DB::table('d_penilaian')
                        -> join('m_layanan', 'd_penilaian.kode_layanan', '=', 'm_layanan.kode_layanan')
                        -> selectRaw('MONTH(d_penilaian.created_at) as bulan, m_layanan.nama_layanan, AVG(d_penilaian.rating_layanan) as rerata, COUNT(d_penilaian.rating_layanan) as jumlah_terlayani')
                        -> whereRaw('YEAR(d_penilaian.created_at) = '. $this->selectedYear)
                        -> where('selesai', 1)
                        -> groupByRaw('MONTH(d_penilaian.created_at), m_layanan.nama_layanan')
                        -> get();
        } else {
            $result = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                    FROM d_penilaian a, m_layanan b WHERE a.kode_satker_id = ' . $this->getUnitCode()->kode_satker . ' AND a.kode_layanan=b.kode_layanan AND YEAR(a.created_at) = '. $this->selectedYear .'
                    GROUP BY a.kode_satker_id, MONTH(a.created_at), a.kode_layanan');
        }

        $column = ['Bulan', 'Nama Layanan', 'Rating Rata-Rata', 'Jumlah Penilaian'];

        return [$column, $result];
    }

    private function getComplaintSuggestion($role)
    {
        $data = array();

        if ($role) {
            $result = DB::table('d_penilaian')
                        -> selectRaw('MONTH(created_at) as bulan, kode_saran')
                        -> whereRaw('YEAR(created_at) = ' . $this->selectedYear)
                        -> where('selesai', 1)
                        -> groupBy('created_at', 'kode_saran')
                        -> get()
                        -> mapToGroups(function($item, $key) {
                            return [$item->bulan => json_decode($item->kode_saran)];
                        })
                        -> all();

            foreach ($result as $index => $d) $data[$index] = $d->flatten()->countBy();
        } else {
            $result = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                    FROM d_penilaian a, m_saran b WHERE a.kode_satker_id = " . $this->getUnitCode()->kode_satker . " AND YEAR(a.created_at) = '. $this->selectedYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                    GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");
        }

        $column = ['Bulan', 'Kategori Saran Pengaduan', 'Jumlah Penilaian'];

        return [$column, $data];
    }
}
