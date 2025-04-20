<?php

declare(strict_types=1);

namespace App\Traits;

trait HasRenderOption
{
    public function renderOption(array $data): ?string
    {
        $result = null;

        foreach($data as $item)
                $result .= "<option value=" . $item[0] . ">" . $item[1] . "</option>";

        if(is_null($result)){
            return '';
        }else{
            return $result;
        }
    }
}
