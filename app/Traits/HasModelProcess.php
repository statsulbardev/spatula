<?php

namespace App\Traits;

use App\Models\m_pengguna;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasModelProcess
{
    /**
     * Eloquent Create and Update Process.
     * @param mixed $model
     * @return string
     */
    public function save($model) : string
    {
        try {
            DB::beginTransaction();

            $model->save();

            DB::commit();

            $notification = "Informasi " . $this->getClassName($model, 2) . " telah disimpan.";

        } catch (Exception $error) {

            DB::rollBack();

            Log::error($error->getMessage());

            $notification = "Informasi " . $this->getClassName($model, 2) . " gagal disimpan.";
        }

        return $notification;
    }

    /**
     * Eloquent Delete Process.
     * @param mixed $model
     * @return string
     */
    public function delete($model) : string
    {
        try {
            DB::beginTransaction();

            $model->delete();

            DB::commit();

            $notification = "Informasi " . $this->getClassName($model, 2) . " telah dihapus.";

        } catch (Exception $error) {

            DB::rollBack();

            Log::error($error->getMessage());

            $notification = "Informasi " . $this->getClassName($model, 2) . " gagal dihapus.";
        }

        return $notification;
    }

    /**
     * Mass Assignment Data
     * @param mixed $data
     * @return string
     */
    public function massAssignment($model, array $data, string $step) : string
    {
        try {
            DB::beginTransaction();

            if ($step === 'tambah') {
                $model->create($data);

                $result = "Informasi " . $this->getClassName($model, 2) . " telah disimpan.";
            } else {
                $model->update($data);

                $result = "Informasi " . $this->getClassName($model, 2) . " telah diperbaharui.";
            }

            DB::commit();
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $result = "Informasi user gagal disimpan.";
        }

        return $result;
    }

    private function getClassName($model, int $substr) : string
    {
        $modelName = substr(class_basename($model), $substr);

        return $modelName;
    }
}
