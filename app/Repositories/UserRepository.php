<?php

namespace App\Repositories;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\Interfaces\ConfigurationInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserRepository
{

    public function save($data) : string
    {
        try {
            DB::beginTransaction();

            $query = m_pengguna::create([
                'nama'           => $data->f_nama,
                'username'       => explode('@', $data->f_email)[0],
                'email'          => $data->f_email,
                'password'       => bcrypt($data->f_password),
                'bpsid'          => $data->f_nip,
                'kode_satker_id' => $data->f_unit ?? auth()->user()->satker->kode_satker,
                'is_petugas'     => $data->f_petugas
            ]);

            $query->assignRole($data->f_role);

            DB::commit();

            $message = "Informasi pengguna telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi pengguna gagal disimpan.";
        }

        return $message;
    }

    public function update($data) : string
    {
        try {
            DB::beginTransaction();

            $data->pengguna->update([
                'nama'           => $data->f_nama,
                'username'       => explode('@', $data->f_email)[0],
                'email'          => $data->f_email,
                'password'       => empty($data->f_password) ? $data->pengguna->getOriginal('password') : bcrypt($data->f_password),
                'bpsid'          => $data->f_nip,
                'kode_satker_id' => $data->f_unit,
                'is_petugas'     => $data->f_petugas
            ]);

            $data->pengguna->syncRoles($data->f_role);

            DB::commit();

            $message = "Informasi pengguna telah diperbaharui.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi pengguna gagal diperbaharui.";
        }

        return $message;
    }

    public function retrieveUnits() : array
    {
        return m_satker::get(['kode_satker', 'nama'])
                -> map(function($item) {
                    return [
                        0 => $item->kode_satker,
                        1 => $item->nama
                    ];
                })->toArray();
    }

    public function retrieveRoles() : array
    {
        return Role::get('name')
                -> map(function($item) {
                    return [
                        0 => $item->name,
                        1 => ucwords(str_replace('-', ' ', $item->name))
                    ];
                })->toArray();
    }
}
