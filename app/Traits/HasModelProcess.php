<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasModelProcess
{
    /**
     * Use for save or update data with all field.
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
     * Use for delete record from database
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
     * Use for update data with specific field only.
     * @param mixed $model
     * @param array $data
     * @return string
     */
    public function customUpdate($model, array $data) : string
    {
        try {
            DB::beginTransaction();

            $model->update($data);

            DB::commit();

            $notification = "Informasi " . $this->getClassName($model, 2) . " telah diperbaharui.";

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $notification = "Informasi " . $this->getClassName($model, 2) . " gagal diperbaharui.";
        }

        return $notification;
    }

    private function getClassName($model, int $substr) : string
    {
        $modelName = substr(class_basename($model), $substr);

        return $modelName;
    }
}
