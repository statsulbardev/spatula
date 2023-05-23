<?php

namespace App\Repositories;

use App\Models\m_layanan;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceRepository
{
    public function save($data) : string
    {
        try {
            DB::beginTransaction();

            m_layanan::create([
                'kode_layanan' => $data->f_kode,
                'nama_layanan' => $data->f_nama,
                'deskripsi'    => $data->f_deskripsi,
                'metode'       => $data->f_metode
            ]);

            DB::commit();

            $message = "Informasi layanan telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi layanan gagal disimpan.";
        }

        return $message;
    }

    public function update($data) : string
    {
        try {
            DB::beginTransaction();

            $data->layanan->update([
                'kode_layanan' => $data->f_kode,
                'nama_layanan' => $data->f_nama,
                'deskripsi'    => $data->f_deskripsi,
                'metode'       => $data->f_metode
            ]);

            DB::commit();

            $message = "Informasi layanan telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi layanan gagal disimpan.";
        }

        return $message;
    }
}
