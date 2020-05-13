<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function monthly()
    {
        // $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get(); -> untuk mysql
        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('year');

        $col3 = collect([]);

        return view('backend.report.month', compact('years', 'col3'));
    }

    public function daily()
    {
        // $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get(); -> untuk mysql
        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('year');
        $data   = d_penilaian::where('selesai', 1)->orderBy('created_at', 'desc')->paginate(15);

        return view('backend.report.daily', compact('years', 'data'));
    }

    public function showDailyDetail(Request $request)
    {
        // $result = d_penilaian::select(DB::Raw('YEAR(created_at) as year'))->distinct()->get(); -> untuk mysql
        $result = d_penilaian::select(DB::Raw('EXTRACT(year from created_at)'))->distinct()->get();
        $years  = $result->pluck('year');

        $data = d_penilaian::whereYear('created_at', '=', $request->tahun)
                ->whereMonth('created_at', '=', $request->bulan)
                ->where('selesai', 1)
                ->get();

        return view('backend.report.daily', compact('years', 'data'));
    }
}
