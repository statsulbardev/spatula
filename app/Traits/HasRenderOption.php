<?php

namespace App\Traits;

trait HasRenderOption
{
    public function renderOption(array $data) : ?string
    {
        $result = null;

        foreach($data as $item)
            $result .= "<option value=" . $item[0] . ">" . $item[1] . "</option>";

        return $result;
    }
}
