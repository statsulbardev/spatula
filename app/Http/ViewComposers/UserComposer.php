<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with('username', Auth::user()->name)->with('photo', Auth::user()->photo_path);
    }
}
