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

        // $sum1 = d_penilaian::where('selesai', 1)
        //        ->whereYear('created_at', $years[0])
        //        ->groupBy('kode_petugas')
        //        ->selectRaw('sum(rating_petugas) as total, kode_petugas')
        //        ->pluck('total', 'kode_petugas');

        // $count1 = d_penilaian::where('selesai', 1)
        //          ->whereYear('created_at', '2020')
        //          ->groupBy('kode_petugas')
        //          ->selectRaw('count(nama_konsumen) as count, kode_petugas')
        //          ->pluck('count', 'kode_petugas');

        $table1 = $table2 = $table3 = collect([]);

        return view('backend.report.month', compact('years', 'table1', 'table2', 'table3'));
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
