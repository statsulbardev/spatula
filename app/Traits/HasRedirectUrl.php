<?php

namespace App\Traits;

use Livewire\Redirector;

trait HasRedirectUrl
{
    public function callbackUrl($url) : Redirector
    {
        return redirect(env('APP_URL') . $url);
    }
}
