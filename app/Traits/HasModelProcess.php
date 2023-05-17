<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasModelProcess
{
    /**
     * Use for save new data or
     * update existing data to database
     * @param mixed $model
     * @return string
     */
    public function save($model) : string
    {
        try {
            DB::beginTransaction();

            $model->save();

            DB::commit();

            $notification = "Informasi telah disimpan.";

        } catch (Exception $error) {

            DB::rollBack();

            Log::error($error->getMessage());

            $notification = "Informasi gagal disimpan.";
        }

        return $notification;
    }

    public function delete($model) : string
    {
        try {
            DB::beginTransaction();

            $model->delete();

            DB::commit();

            $notification = "Informasi telah dihapus.";

        } catch (Exception $error) {

            DB::rollBack();

            Log::error($error->getMessage());

            $notification = "Informasi gagal dihapus.";
        }

        return $notification;
    }
}
