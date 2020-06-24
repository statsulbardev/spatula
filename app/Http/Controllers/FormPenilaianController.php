<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPenilaianValidation;
use App\Mail\SendMail;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\PenilaianLayananRepository;
use App\Repositories\PenilaianPetugasRepository;
use Illuminate\Support\Facades\Mail;

class FormPenilaianController extends Controller
{
    /**
     * Menampilkan halaman penilaian petugas menurut satker dan jenis layanan.
     *
     * @param String $satker
     * @param int $layanan
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Menampilkan halaman penilaian layanan menurut satker dan jenis layanan.
     *
     * @param String $satker
     * @param int $layanan
     * @return \Illuminate\Http\Response
     */
    public function layananForm($satker, $layanan = null)
    {
        $kantor = m_satker::where('kode_satker', $satker)->first();

        if($layanan < 7 || $layanan > 10) $layanan = null;

        !is_null($layanan) ?
            $j_layanan = m_layanan::where('kode_form', '2')->where('kode_layanan', $layanan)->get(['id', 'nama_layanan']) :
            $j_layanan = m_layanan::where('kode_form', '2')->get(['id', 'nama_layanan']);

        return view('frontend.second-form', compact('kantor', 'j_layanan'));
    }

    public function storePetugasForm(FormPenilaianValidation $request, PenilaianPetugasRepository $repository, $satker)
    {
        $namaSatker = m_satker::where('kode_satker', $satker)->first(['id', 'nama']);
        $pjLayanan  = m_pengguna::where('kode_satker_id', $namaSatker->id)->where('role_id', 4)->first('nama');

        // coba pakai laravel queue untuk pengiriman email di background
        if(!is_null($request->email_konsumen)) {
            $to_name  = $request->nama_konsumen;
            $to_email = $request->email_konsumen;
            $data     = array('title' => $to_name, 'pj_layanan' => $pjLayanan->nama ,'satker' => $namaSatker->nama);
            $subject  = "Terima kasih telah memberikan penilaian pada layanan kami.";
            $template = "notification";

            Mail::to($to_email)->send(new SendMail($subject, $data, $template));
        }

        $repository->store($request, $satker);

        alert()->success('Info','Terima Kasih Atas Partisipasi Anda.');

        return redirect()->back();
    }

    public function storeLayananForm(FormPenilaianValidation $request, PenilaianLayananRepository $repository, $satker)
    {
        $namaSatker = m_satker::where('kode_satker', $satker)->first(['id', 'nama']);
        $pjLayanan  = m_pengguna::where('kode_satker_id', $namaSatker->id)->where('role_id', 4)->first('nama');

        // coba pakai laravel queue untuk pengiriman email di background
        if(!is_null($request->email_konsumen)) {
            $to_name  = $request->nama_konsumen;
            $to_email = $request->email_konsumen;
            $data     = array('title' => $to_name, 'pj_layanan' => $pjLayanan->nama ,'satker' => $namaSatker->nama);
            $subject  = "Terima kasih telah memberikan penilaian pada layanan kami.";
            $template = "notification";

            Mail::to($to_email)->send(new SendMail($subject, $data, $template));
        }

        $repository->store($request, $satker);

        alert()->success('Info','Terima Kasih Atas Partisipasi Anda.');

        return redirect()->back();
    }
}
