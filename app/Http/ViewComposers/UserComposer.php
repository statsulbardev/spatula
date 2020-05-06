<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view -> with('username', Auth::user()->nama)
              -> with('photo', Auth::user()->foto)
              -> with('role', Auth::user()->role_id);
    }
}
