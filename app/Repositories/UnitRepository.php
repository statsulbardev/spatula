<?php

namespace App\Repositories;

use App\Models\m_satker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitRepository
{
    public function save($data) : string
    {
        try {
            DB::beginTransaction();

            m_satker::create([
                'kode_satker' => $data->f_kode,
                'nama'        => $data->f_nama,
                'level'       => $data->f_level,
                'alamat'      => $data->f_alamat,
                'web'         => $data->f_web,
                'telepon'     => $data->f_telepon
            ]);

            DB::commit();

            $message = "Informasi satker telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi satker gagal disimpan.";
        }

        return $message;
    }

    public function update($data) : string
    {
        try {
            DB::beginTransaction();

            $data->satker->update([
                'kode_satker' => $data->f_kode,
                'nama'        => $data->f_nama,
                'level'       => $data->f_level,
                'alamat'      => $data->f_alamat,
                'web'         => $data->f_web,
                'telepon'     => $data->f_telepon
            ]);

            DB::commit();

            $message = "Informasi satker telah diperbaharui.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi satker gagal diperbaharui.";
        }

        return $message;
    }
}
