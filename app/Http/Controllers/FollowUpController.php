<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use App\Mail\SendMail;
use App\Models\m_pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class FollowUpController extends Controller
{

        public function simpanDataLayanan(Request $request, $id)
    {

    }

    public function akhiriKonfirmasiLayanan($id)
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        return redirect()->route('followup.service');
    }

    public function listPjPengaduan()
    {
        if(Auth::user()->role_id === 1) {
            $data = d_penilaian::where('selesai', 0)
                    ->where('is_pengaduan', 1)
                    ->paginate(15);
        } else {
            $kodeSatker = $this->getSatkerKode();

            $data = d_penilaian::where('selesai', 0)
                    ->where('kode_satker_id', $kodeSatker->kode_satker)
                    ->where('is_pengaduan', 1)
                    ->paginate(15);
        }

        return view('backend.followup.complaint', [
            'complaints' => $data
        ]);
    }

    public function detailPjPengaduan($id)
    {
        $complaintDetail = d_penilaian::where('id', $id)
                           -> where('selesai', 0)
                           -> where('is_pengaduan', 1)
                           -> first();

        return view('backend.followup.detail-complaint', compact('complaintDetail'));
    }

    public function kirimDataPengaduan($id)
    {
        $customer = d_penilaian::findOrFail($id);

        return view('backend.followup.sent-complaint', [
            'customer' => $customer
        ]);
    }

    public function simpanDataPengaduan(Request $request, $id)
    {
        $customer = d_penilaian::findOrFail($id);

        switch($request->button) {
            case 'whatsapp':
                if(is_null($request->text_pj_pengaduan) || trim($request->text_pj_pengaduan, "") === "") {
                    alert()->warning('Tindak Lanjut Pengaduan', 'Pesan tindak lanjut harus terisi.');
                    return redirect()->to(env('APP_URL') . 'tindak-lanjut/kirim-pengaduan/' . $id);
                } else {
                    $customer->update([
                        'text_pj_pengaduan' => $request->text_pj_pengaduan,
                        'tanggal_tl_pj_pengaduan' => Carbon::now()
                    ]);

                    $phone = $this->changeNumber($customer->no_wa_telepon);
                    $message = $customer->text_pj_pengaduan;

                    return redirect()->to("https://api.whatsapp.com/send?phone=$phone&text=$message");

                    break;
                }
            case 'email':
                if(is_null($request->text_pj_pengaduan) || trim($request->text_pj_pengaduan, "") === "") {
                    alert()->warning('Tindak Lanjut Pengaduan', 'Pesan tindak lanjut harus terisi.');
                    return redirect()->to(env('APP_URL') . 'tindak-lanjut/kirim-pengaduan/' . $id);
                } else {
                    $customer->update([
                        'text_pj_pengaduan' => $request->text_pj_pengaduan,
                        'tanggal_tl_pj_pengaduan' => Carbon::now()
                    ]);

                    $userId = Auth::user()->id;
                    $userSatkerId = m_pengguna::find($userId);
                    $namaSatker = $userSatkerId->satker()->first('nama');

                    $to_name  = $customer->nama_konsumen;
                    $to_email = $customer->email_konsumen;
                    $pesan    = $customer->text_pj_pengaduan;
                    $data     = array('title' => $to_name, 'body' => $pesan, 'satker' => $namaSatker->nama);
                    $subject  = "Terima kasih atas penilaian anda.";
                    $template = "pj-layanan";

                    Mail::to($to_email)->send(new SendMail($subject, $data, $template));

                    alert()->success('Tindak Lanjut Pengaduan', 'Pesan tindak lanjut telah terkirim.');

                    return redirect()->route('followup.complaint');

                    break;
                }
        }
    }

    private function changeNumber($number)
    {
        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($number))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($number), 0, 3)=='+62'){
                $hp = trim($number);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($number), 0, 1)=='0'){
                $hp = '+62'.substr(trim($number), 1);
            }
        }

        return $hp;
    }

    private function getSatkerKode()
    {

    }
}
