<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with([
            'nama'   => auth()->user()->nama,
            'foto'   => auth()->user()->foto,
            'satker' => auth()->user()->satker->nama
        ]);
    }
}
