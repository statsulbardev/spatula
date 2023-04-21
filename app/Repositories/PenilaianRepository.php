<?php

namespace App\Repositories;

use App\Models\d_penilaian;
use App\Models\m_satker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaianRepository
{
    public function store($data) : string
    {
        try {
            DB::beginTransaction();
            d_penilaian::create([
                'nama_konsumen'   => $data->f_nama,
                'email_konsumen'  => $data->f_email,
                'no_wa_telepon'   => $data->f_notelpwhatsapp,
                'kode_satker_id'  => m_satker::findOrFail(explode('-', $data->f_unit)[0])->first('kode_satker')->kode_satker,
                'kode_petugas'    => $data->f_petugas ?? null,
                'rating_petugas'  => $data->f_ratingpetugas ?? null,
                'kode_layanan'    => explode('-', $data->f_layanan)[0],
                'rating_layanan'  => $data->f_ratinglayanan,
                'saran_pengaduan' => $data->f_saranpengaduan,
                'selesai'         => false
            ]);

            $message = "Penilaian anda telah tersimpan, terima kasih.";

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error->getMessage());

            $message = "Penilaian anda gagal disimpan, mohon dicoba kembali.";
        }

        return $message;
    }
}
