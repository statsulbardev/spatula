<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_satker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormPenilaianController extends Controller
{
    public function petugasForm($satker, $layanan = null)
    {
        $kantor    = m_satker::where('kode_satker', $satker)->first();

        $petugas   = $kantor->pengguna()->where('role_id', 7)->where('aktif', 1)->get();

        if($layanan < 1 || $layanan > 6) $layanan = null;

        !is_null($layanan) ?
            $j_layanan = m_layanan::where('kode_form', '1')->where('kode_layanan', $layanan)->get(['id', 'nama_layanan']) :
            $j_layanan = m_layanan::where('kode_form', '1')->get(['id', 'nama_layanan']);

        return view('frontend.first-form', compact('kantor', 'petugas', 'j_layanan'));
    }

    public function layananForm($satker, $layanan = null)
    {
        $kantor = m_satker::where('kode_satker', $satker)->first();

        if($layanan < 7 || $layanan > 10) $layanan = null;

        !is_null($layanan) ?
            $j_layanan = m_layanan::where('kode_form', '2')->where('kode_layanan', $layanan)->get(['id', 'nama_layanan']) :
            $j_layanan = m_layanan::where('kode_form', '2')->get(['id', 'nama_layanan']);

        return view('frontend.second-form', compact('kantor', 'j_layanan'));
    }

    public function storePetugasForm(Request $request, $satker)
    {
        $request->validate([
            'nama_konsumen'   => 'required|string',
            'email_konsumen'  => 'nullable|email',
            'no_wa_telepon'   => 'nullable',
            'saran_pengaduan' => 'required|string'
        ]);

        // coba pakai laravel queue untuk pengiriman email di background
        // if(!is_null($request->email_konsumen)) {
        //     $to_name  = $request->nama_konsumen;
        //     $to_email = $request->email_konsumen;
        //     $data     = array('title' => $to_name);
        //     $subject  = "Terima kasih telah memberikan penilaian pada layanan kami.";
        //     $template = "notification";

        //     Mail::to($to_email)->send(new SendMail($subject, $data, $template));
        // }

        d_penilaian::insert([
            'nama_konsumen'   => $request->nama_konsumen,
            'email_konsumen'  => $request->email_konsumen,
            'no_wa_telepon'   => $request->no_wa_telepon,
            'kode_petugas'    => $request->kode_petugas,
            'rating_petugas'  => $request->rating_petugas,
            'kode_layanan'    => $request->kode_layanan,
            'rating_layanan'  => $request->rating_layanan,
            'saran_pengaduan' => $request->saran_pengaduan,
            'kode_satker_id'  => $satker,
            'selesai'         => false,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);

        alert()->success('Info','Terima Kasih Atas Partisipasi Anda.');

        return redirect()->back();
    }

    public function storeLayananForm(Request $request, $satker)
    {
        $request->validate([
            'nama_konsumen'   => 'required|string',
            'email_konsumen'  => 'nullable|email',
            'no_wa_telepon'   => 'nullable',
            'saran_pengaduan' => 'required|string'
        ]);

        // coba pakai laravel queue untuk pengiriman email di background
        // if(!is_null($request->email_konsumen)) {
        //     $to_name  = $request->nama_konsumen;
        //     $to_email = $request->email_konsumen;
        //     $data     = array('title' => $to_name);
        //     $subject  = "Terima kasih telah memberikan penilaian pada layanan kami.";
        //     $template = "notification";

        //     Mail::to($to_email)->send(new SendMail($subject, $data, $template));
        // }

        d_penilaian::insert([
            'nama_konsumen'   => $request->nama_konsumen,
            'email_konsumen'  => $request->email_konsumen,
            'no_wa_telepon'   => $request->no_wa_telepon,
            'kode_layanan'    => $request->kode_layanan,
            'rating_layanan'  => $request->rating_layanan,
            'saran_pengaduan' => $request->saran_pengaduan,
            'kode_satker_id'  => $satker,
            'selesai'         => false,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);

        alert()->success('Info','Terima Kasih Atas Partisipasi Anda.');

        return redirect()->back();
    }


}
