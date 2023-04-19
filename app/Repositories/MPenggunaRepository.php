<?php

namespace App\Repositories;

use App\Models\m_pengguna;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class MPenggunaRepository
{
    public function store($data) : string
    {
        try {
            DB::beginTransaction();

            $user = m_pengguna::create([
                'nama'           => $data->f_name,
                'username'       => explode('@', $data->f_email)[0],
                'email'          => $data->f_email,
                'password'       => bcrypt($data->f_password),
                'bpsid'          => $data->f_bpsid,
                'kode_satker_id' => $data->f_unit,
                'aktif'          => true,
                'foto'           => null
            ]);

            $user->assignRole(Role::find($data->f_role, ['name'])->name);

            $message = "Info user telah disimpan.";

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error->getMessage());

            $message = "Gagal menyimpan info user.";
        }

        return $message;
    }

    public function update($data) : string
    {
        try {
            DB::beginTransaction();

            $data->user->update([
                'nama'           => $data->f_name,
                'username'       => explode('@', $data->f_email)[0],
                'email'          => $data->f_email,
                'password'       => bcrypt($data->f_password) ?? null,
                'bpsid'          => $data->f_bpsid,
                'kode_satker_id' => $data->f_unit,
            ]);

            // Remove Role
            $data->user->removeRole($data->user->roles[0]->name);

            // Assign New Role
            $data->user->assignRole(Role::find($data->f_role, ['name'])->name);

            $message = "Info user telah diupdate";

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error->getMessage());

            $message = "Info user gagal diupdate";
        }

        return $message;
    }
}
