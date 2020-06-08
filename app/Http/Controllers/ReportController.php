<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function monthly()
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

        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('date_part');

        // Rating Petugas
        $query_1 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama , AVG(rating_petugas) as rerata, COUNT(rating_petugas) as jumlah_terlayani
                   FROM d_penilaian a, m_pengguna b WHERE YEAR(a.created_at) = 2020 AND a.kode_petugas=b.id
                   GROUP BY YEAR(a.created_at), MONTH(a.created_at), kode_petugas');

        // Rating Layanan
        $query_2_3 = DB::select('SELECT MONTH(a.created_at) as bulan, b.nama_layanan , AVG(rating_layanan) as rerata, COUNT(rating_layanan) as jumlah_terlayani
                FROM d_penilaian a, m_layanan b WHERE YEAR(a.created_at) = 2020 AND a.kode_layanan=b.kode_layanan
                GROUP BY YEAR(a.created_at), MONTH(a.created_at), a.kode_layanan');

        return view('backend.report.month', compact('years', 'query_1', 'query_2_3'));
    }

    public function daily()
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

        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('date_part');

        $data   = d_penilaian::where('selesai', 1)->orderBy('created_at', 'desc')->paginate(15);

        return view('backend.report.daily', compact('years', 'data'));
    }

    public function showDailyDetail(Request $request)
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

        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('date_part');

        $data = d_penilaian::whereYear('created_at', '=', $request->tahun)
                ->whereMonth('created_at', '=', $request->bulan)
                ->where('selesai', 1)
                ->get();

        return view('backend.report.daily', compact('years', 'data'));
    }
}
