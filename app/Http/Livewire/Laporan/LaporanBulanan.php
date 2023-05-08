<?php

namespace App\Http\Livewire\Laporan;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanBulanan extends Component
{
    use UnitCode, WithPagination;

    public $officerRating;
    public $serviceRating;
    public $complaintSuggestion;
    public $years;
    public $selectedYear;
    public $selectedReport;

    public function render()
    {
        return view('livewire.laporan.laporan-bulanan')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->selectedYear = date('Y');

        $this->getYears();

        dd($this->getComplaintSuggestion(Auth::user()->hasRole('superadmin')));

        $this->officerRating = $this->getOfficerRating(Auth::user()->hasRole('superadmin'));

        $this->serviceRating = $this->getServiceRating(Auth::user()->hasRole('superadmin'));

        $this->complaintSuggestion = $this->getComplaintSuggestion(Auth::user()->hasRole('superadmin'));
    }

    private function getYears()
    {
        $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
        $this->years  = $result->pluck('year');
    }

    private function getOfficerRating($role)
    {
        if ($role) {
            $result = DB::select(
                        'SELECT
                            MONTH(a.created_at) as bulan,
                            b.nama,
                            AVG(a.rating_petugas) as rerata,
                            COUNT(a.rating_petugas) as jumlah_terlayani
                        FROM
                            d_penilaian a,
                            m_pengguna b
                        WHERE
                            a.kode_petugas = b.id AND
                            YEAR(a.created_at) = ' . $this->selectedYear . '
                        GROUP BY
                            MONTH(a.created_at),
                            b.nama'
                        );
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
            $result = DB::select(
                        'SELECT
                            MONTH(a.created_at) as bulan,
                            b.nama_layanan,
                            AVG(a.rating_layanan) as rerata,
                            COUNT(a.rating_layanan) as jumlah_terlayani
                        FROM
                            d_penilaian a,
                            m_layanan b
                        WHERE
                            a.kode_layanan = b.kode_layanan AND
                            YEAR(a.created_at) = '. $this->selectedYear .'
                        GROUP BY
                            MONTH(a.created_at),
                            b.nama_layanan'
                        );
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
        if ($role) {
            $result = DB::select(
                        "SELECT
                            MONTH(a.created_at) as bulan,
                            b.nama_saran,
                            COUNT(a.kode_saran) as jumlah_saran
                        FROM
                            d_penilaian a,
                            m_saran b
                        WHERE
                            YEAR(a.created_at) = '. $this->selectedYear .' AND
                            a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                        GROUP BY
                            MONTH(a.created_at),
                            b.nama_saran"
                        );
        } else {
            $result = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                    FROM d_penilaian a, m_saran b WHERE a.kode_satker_id = " . $this->getUnitCode()->kode_satker . " AND YEAR(a.created_at) = '. $this->selectedYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                    GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");
        }

        return $result;
    }
}
