<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use Carbon\Carbon;
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

    public function service()
    {
        return view('backend.followup.service', [
            'services' => d_penilaian::where('selesai', 0)->paginate(15)
        ]);
    }

    public function categorize($id)
    {
        return view('backend.followup.categorize', [
            'customer' => d_penilaian::findOrFail($id)
        ]);
    }

    public function storeCategory(Request $request, $id)
    {
        // cek jika tidak dicentang salah satunya
        $data = [
            'saran'     => $request->saran ? 1 : null,
            'pengaduan' => $request->pengaduan ? 2 : null,
            'kritik'    => $request->kritik ? 3 : null,
            'apresiasi' => $request->apreseiasi ? 4 : null,
            'lainnya'   => $request->lainnya ? 9 : null,
        ];

        if(count(array_filter($data)) === 0) {
            return redirect()->back();
        }

        $customer = d_penilaian::find($id);

        $customer->update([
            'kode_saran' => array_filter($data),
            'tanggal_kategorisasi' => Carbon::now()
        ]);

        return redirect()->route('followup.service')->with('success', 'Data Telah Ditambahkan.');
    }

    public function sentPage($id)
    {
        $customer = d_penilaian::findOrFail($id);

        return view('backend.followup.sent', [
            'customer' => $customer
        ]);
    }

    public function storeSent(Request $request, $id)
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'text_pj_layanan' => $request->text_pj_layanan,
            'tanggal_tl_pj_layanan' => Carbon::now()
        ]);

        switch($request->button) {
            case 'whatsapp':

                break;
            case 'email':
                break;
        }
    }

    public function finish($id)
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        return redirect()->route('followup.service');
    }
}
