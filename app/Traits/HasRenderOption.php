<?php

namespace App\Traits;

trait HasRenderOption
{
    /**
     * Render option satuan kerja untuk pilihan
     * pada select-option.
     * @param mixed $model
     * @return string
     */
    public function renderUnitsOption($model) : string
    {
        $result = null;

        foreach($model as $item)
            $result .= "<option value=" . $item->id . ">" . $item->nama . "</option>";

        return $result;
    }

    /**
     * Render option level satuan kerja untuk pilihan
     * pada select-option.
     * @return string
     */
    public function renderLevelOption() : string
    {
        $result = "<option value='1'>Provinsi</option><option value='2'>Kabupaten</option>";

        return $result;
    }

    /**
     * Render option daftar role untuk pilihan
     * pada select-option.
     * @param mixed $model
     * @return string
     */
    public function renderRolesOption($model) : string
    {
        $result = null;

        foreach($model as $item)
            $result .= "<option value=" . $item->id . ">" . ucwords(str_replace("-", " ", $item->name)) . "</option>";

        return $result;
    }
}
