<?php

namespace App\Http\Livewire\Report;

use App\Models\d_penilaian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Monthly extends Component
{
    public $years;
    public $tahun;
    public $query_1;
    public $query_2;
    public $query_3;

    public function mount()
    {
        /**
         * Untuk MySQL
         *
         * $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
         * $years  = $result->pluck('year');
         */

        /**
         * Untuk PostgreSQL
         *
         * $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
         * $years  = $result->pluck('date_part');
         */

         $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
         $this->years  = $result->pluck('year');
         $currentYear = date('Y');
         $this->tahun = $currentYear;

        if(Auth::user()->role_id === 1) {
            // Rating Petugas
            $this->query_1 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama , AVG(rating_petugas) as rerata, COUNT(rating_petugas) as jumlah_terlayani
                    FROM d_penilaian a, m_pengguna b WHERE a.kode_petugas=b.id and YEAR(a.created_at) = ' . $currentYear . ' GROUP BY MONTH(a.created_at), kode_petugas');

            // Rating Saran Pengaduan
            $this->query_2 = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                    FROM d_penilaian a, m_saran b WHERE YEAR(a.created_at) = '. $currentYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                    GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");

            // Rating Layanan
            $this->query_3 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                    FROM d_penilaian a, m_layanan b WHERE a.kode_layanan=b.kode_layanan AND YEAR(a.created_at) = '. $currentYear .' GROUP BY MONTH(a.created_at), a.kode_layanan');

        } else {
            $kodeSatker = $this->getSatkerKode();

            // Rating Petugas
            $this->query_1 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama , AVG(rating_petugas) as rerata, COUNT(rating_petugas) as jumlah_terlayani
                    FROM d_penilaian a, m_pengguna b WHERE a.kode_satker_id = ' . $kodeSatker->kode_satker . ' AND a.kode_petugas=b.id AND YEAR(a.created_at) = '. $currentYear .'
                    GROUP BY a.kode_satker_id, MONTH(a.created_at), kode_petugas');

            // Rating Saran Pengaduan
            $this->query_2 = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                    FROM d_penilaian a, m_saran b WHERE a.kode_satker_id = " . $kodeSatker->kode_satker . " AND YEAR(a.created_at) = '. $currentYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                    GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");

            // Rating Layanan
            $this->query_3 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                    FROM d_penilaian a, m_layanan b WHERE a.kode_satker_id = ' . $kodeSatker->kode_satker . ' AND a.kode_layanan=b.kode_layanan AND YEAR(a.created_at) = '. $currentYear .'
                    GROUP BY a.kode_satker_id, MONTH(a.created_at), a.kode_layanan');
        }
    }

    public function render()
    {
        return view('livewire.report.monthly')
            ->layout('layouts.app');
    }

    public function detail()
    {

        $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
        $years  = $result->pluck('year');
        $selectedYear = $yearSelect;
        $tahun = $selectedYear;

        if (Auth::user()->role_id === 1) {
            // Rating Petugas
            $query_1 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama , AVG(rating_petugas) as rerata, COUNT(rating_petugas) as jumlah_terlayani
                       FROM d_penilaian a, m_pengguna b WHERE a.kode_petugas=b.id and YEAR(a.created_at) = ' . $selectedYear . ' GROUP BY MONTH(a.created_at), kode_petugas');

            // Rating Saran Pengaduan
            $query_2 = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                       FROM d_penilaian a, m_saran b WHERE YEAR(a.created_at) = '. $selectedYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                       GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");

            // Rating Layanan
            $query_3 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                       FROM d_penilaian a, m_layanan b WHERE a.kode_layanan=b.kode_layanan AND YEAR(a.created_at) = '. $selectedYear .' GROUP BY MONTH(a.created_at), a.kode_layanan');
        } else {
            $kodeSatker = $this->getSatkerKode();

            // Rating Petugas
            $query_1 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama , AVG(rating_petugas) as rerata, COUNT(rating_petugas) as jumlah_terlayani
                       FROM d_penilaian a, m_pengguna b WHERE a.kode_satker_id = ' . $kodeSatker->kode_satker . ' AND a.kode_petugas=b.id AND YEAR(a.created_at) = '. $selectedYear .'
                       GROUP BY a.kode_satker_id, MONTH(a.created_at), kode_petugas');

            // Rating Saran Pengaduan
            $query_2 = DB::select("SELECT MONTH(a.created_at) as bulan, b.nama_saran , COUNT(a.kode_saran) as jumlah_saran
                       FROM d_penilaian a, m_saran b WHERE a.kode_satker_id = " . $kodeSatker->kode_satker . " AND YEAR(a.created_at) = '. $selectedYear .' AND a.kode_saran LIKE CONCAT('%', b.kode_saran ,'%')
                       GROUP BY YEAR(a.created_at), MONTH(a.created_at), b.kode_saran");

            // Rating Layanan
            $query_3 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                       FROM d_penilaian a, m_layanan b WHERE a.kode_satker_id = ' . $kodeSatker->kode_satker . ' AND a.kode_layanan=b.kode_layanan AND YEAR(a.created_at) = '. $selectedYear .'
                       GROUP BY a.kode_satker_id, MONTH(a.created_at), a.kode_layanan');
        }
    }
}
