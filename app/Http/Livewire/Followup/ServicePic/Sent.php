<?php

namespace App\Http\Livewire\Followup\ServicePic;

use App\Models\d_penilaian;
use Livewire\Component;

class Sent extends Component
{
    public $customer;
    public $comment;
    public $button;

    public function mount(d_penilaian $id)
    {
        $this->customer = $id;
    }

    public function render()
    {
        return view('livewire.followup.service-pic.sent');
    }

    public function switch($val)
    {
        $this->button = $val;
    }

    public function store()
    {
        switch($this->button)
        {
            case 'whatsapp':
                if (is_null($this->comment) || trim($this->comment, "") === "") {
                    alert()->warning('Tindak Lanjut Layanan', 'Pesan tindak lanjut harus terisi.');
                    return redirect()->back();
                } else {
                    $customer->update([
                        'text_pj_layanan' => $request->text_pj_layanan,
                        'tanggal_tl_pj_layanan' => Carbon::now()
                    ]);

                    $phone = $this->changeNumber($customer->no_wa_telepon);
                    $message = $customer->text_pj_layanan;

                    return redirect()->to("https://api.whatsapp.com/send?phone=$phone&text=$message");
                    break;
                }
            case 'email':
                if(is_null($request->text_pj_layanan) || trim($request->text_pj_layanan, "") === "") {
                    alert()->warning('Tindak Lanjut Layanan', 'Pesan tindak lanjut harus terisi.');
                    return redirect()->to(env('APP_URL') . 'tindak-lanjut/kirim/' . $id);
                } else {
                    $customer->update([
                        'text_pj_layanan' => $request->text_pj_layanan,
                        'tanggal_tl_pj_layanan' => Carbon::now()
                    ]);

                    $userId = Auth::user()->id;
                    $userSatkerId = m_pengguna::find($userId);
                    $namaSatker = $userSatkerId->satker()->first('nama');

                    $to_name  = $customer->nama_konsumen;
                    $to_email = $customer->email_konsumen;
                    $pesan    = $customer->text_pj_layanan;
                    $data     = array('title' => $to_name, 'body' => $pesan, 'satker' => $namaSatker->nama);
                    $subject  = "Terima kasih atas penilaian anda.";
                    $template = "pj-layanan";

                    Mail::to($to_email)->send(new SendMail($subject, $data, $template));

                    alert()->success('Tindak Lanjut Layanan', 'Pesan tindak lanjut telah terkirim.');

                    return redirect()->route('followup.service');

                    break;
                }
        }
    }
}
