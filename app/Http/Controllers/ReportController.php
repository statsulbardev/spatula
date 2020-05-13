<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
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

        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('date_part');

        $col3 = collect([]);

        return view('backend.report.month', compact('years', 'col3'));
    }

    public function daily()
    {
        /**
         * Untuk MySQL
         *
         * $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get();
         * $years  = $result->pluck('year');
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

        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('date_part');

        $data = d_penilaian::whereYear('created_at', '=', $request->tahun)
                ->whereMonth('created_at', '=', $request->bulan)
                ->where('selesai', 1)
                ->get();

        return view('backend.report.daily', compact('years', 'data'));
    }
}
