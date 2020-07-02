<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function __invoke()
    {
        return view('backend.panduan.index');
    }
}
