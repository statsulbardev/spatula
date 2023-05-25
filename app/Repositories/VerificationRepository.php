<?php

namespace App\Repositories;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerificationRepository
{
    public function verifyByServiceOfficer($data, $verification) : string
    {
        try {
            DB::beginTransaction();

            $data->pengguna_layanan->update([
                'kode_layanan'         => $data->f_layanan ?? null,
                'kode_petugas'         => $data->f_petugas ?? null,
                'rating_petugas'       => 5,
                'kode_saran'           => array_values(array_filter($verification)), // remove null values and reindex
                'is_pengaduan'         => $data->cb_pengaduan ? 1 : 0,
                'tanggal_kategorisasi' => Carbon::now(),
                'catatan'              => $data->f_catatan ?? null
            ]);

            DB::commit();

            $message = "Informasi verifikasi layanan telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi verifikasi layanan gagal disimpan.";
        }

        return $message;
    }

}
