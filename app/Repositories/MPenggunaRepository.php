<?php

namespace App\Repositories;

use App\Models\m_pengguna;
use App\Traits\FileUploadable;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MPenggunaRepository
{
    use FileUploadable;

    public function store($data) : string
    {
        try {
            DB::beginTransaction();

            $path = $this->uploadFile('image', $data->photo, $data->photoExtension);

            m_pengguna::create([
                'nama'           => $data->fullname,
                'username'       => explode('@', $data->email)[0],
                'email'          => $data->email,
                'password'       => bcrypt($data->password),
                'bpsid'          => $data->bpsid,
                'role_id'        => $data->role,
                'kode_satker_id' => $data->unit,
                'aktif'          => true,
                'foto'           => $path ?? null
            ]);

            $message = "Informasi user telah disimpan.";

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            $this->deleteFile($path);

            Log::alert($error->getMessage());

            $message = "Gagal menyimpan informasi user.";
        }

        return $message;
    }

    public function update($data) : string
    {
        try {
            DB::beginTransaction();

            $data->user->update([
                'nama'           => $data->fullname,
                'username'       => explode('@', $data->email)[0],
                'email'          => $data->email,
                'bpsid'          => $data->bpsid,
                'role_id'        => $data->role,
                'kode_satker_id' => $data->unit,
            ]);

            if (!is_null($data->password)) $data->user->update(['password' => bcrypt($data->password)]);

            if (!is_null($data->photo)) {
                $path = $this->uploadFile('image', $data->photo, $data->photoExtension);
                $data->user->update(['foto' => $path]);
            }

            $message = "Informasi " . $data->fullname . " telah diperbaharui.";

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            $this->deleteFile($path);

            Log::alert($error->getMessage());

            $message = "Informasi " . $data->fullname . " gagal diperbaharui.";
        }

        return $message;
    }
}
