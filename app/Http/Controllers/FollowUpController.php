<?php

namespace App\Http\Controllers;

use App\Models\d_penilaian;
use App\Mail\SendMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data = d_penilaian::where('selesai', 0)->paginate(15);

        return view('backend.followup.service', [
            'services' => $data
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

        $data = [
            $request->saran ? 1 : null,
            $request->pengaduan ? 2 : null,
            $request->kritik ? 3 : null,
            $request->apresiasi ? 4 : null,
            $request->lainnya ? 9 : null,
        ];

        if(count(array_filter($data)) === 0) {
            return redirect()->back();
        }

        $customer = d_penilaian::find($id);

        if($request->pengaduan) {
            $customer->update([
                'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                'is_pengaduan' => 1,
                'tanggal_kategorisasi' => Carbon::now()
            ]);
        } else {
            $customer->update([
                'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                'is_pengaduan' => 0,
                'tanggal_kategorisasi' => Carbon::now()
            ]);
        }

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
                $phone = $this->changeNumber($customer->no_wa_telepon);
                $message = $customer->text_pj_layanan;

                return redirect()->to("https://api.whatsapp.com/send?phone=$phone&text=$message");
                break;
            case 'email':
                $to_name  = $customer->nama_konsumen;
                $to_email = $customer->email_konsumen;
                $pesan    = $customer->text_pj_layanan;
                $data     = array('title' => $to_name, 'body' => $pesan);

                Mail::to($to_email)->send(new SendMail($data));
                return redirect()->route('followup.service');

                break;
            default:
                return redirect()->route('followup.service');
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

    public function complaint()
    {
        $data = d_penilaian::where('selesai', 0)
                ->where('is_pengaduan', 1)
                ->paginate(15);

        return view('backend.followup.complaint', [
            'complaints' => $data
        ]);
    }

    public function sentComplaint($id)
    {
        $customer = d_penilaian::findOrFail($id);

        return view('backend.followup.sent-complaint', [
            'customer' => $customer
        ]);
    }

    public function sentComplaintStore(Request $request, $id)
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'text_pj_pengaduan' => $request->text_pj_pengaduan,
            'tanggal_tl_pj_pengaduan' => Carbon::now()
        ]);

        switch($request->button) {
            case 'whatsapp':
                $phone = $this->changeNumber($customer->no_wa_telepon);
                $message = $customer->text_pj_pengaduan;

                return redirect()->to("https://api.whatsapp.com/send?phone=$phone&text=$message");

                break;
            case 'email':
                $to_name  = $customer->nama_konsumen;
                $to_email = $customer->email_konsumen;
                $pesan    = $customer->text_pj_pengaduan;
                $data     = array('name' => 'Seksi DLS', 'body' => $pesan);

                Mail::send('backend.emails.mail', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Test Email');

                    $message->from('SENDER_EMAIL_ADDRESS', 'Test Email');
                });

                break;
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
}
