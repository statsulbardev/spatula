<?php

namespace App\Repositories;

use App\Models\m_layanan;
use App\Repositories\Interfaces\ConfigurationInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceRepository implements ConfigurationInterface
{
     /**
     * Store New Data Into Database.
     * @param mixed $data
     * @return string
     */
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

     /**
     * Update Database With Present Values.
     * @param mixed $data
     * @return string
     */
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
