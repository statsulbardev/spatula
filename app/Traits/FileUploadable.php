<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadable
{
    protected $disk = 'bps';

    public function uploadFile(string $folder, string $file, string $extension) : string
    {
        if (strpos($file, ',') !== false) @list($encode, $convert) = explode(',', $file);

        $convertFile = base64_decode($convert, true);

        $name = 'foto-' . Str::random(8) . '.' . $extension;

        Storage::disk($this->disk)->put($folder . '/' . $name, $convertFile);

        return $name;
    }

    public function deleteFile(string $file) : void
    {
        Storage::disk($this->disk)->delete($file);
    }
}
