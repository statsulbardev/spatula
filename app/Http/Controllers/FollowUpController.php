<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function done()
    {
        return view('backend.followup.done', [
            'dones' => d_penilaian::where('selesai', 1)->orderBy('tanggal_selesai', 'desc')->paginate(15)
        ]);
    }

    public function showDone($id)
    {
        $done = d_penilaian::where('id', $id)->where('selesai', 1)->get();

        return view('backend.followup.detail-done', compact('done'));
    }
}
