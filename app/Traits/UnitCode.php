<?php

namespace App\Traits;

use App\Models\m_pengguna;
use Illuminate\Support\Facades\Auth;

trait UnitCode
{
    public function getUnitCode()
    {
        $userSatkerId = m_pengguna::find(Auth::id());

        return $userSatkerId->satker()->first('kode_satker');
    }
}
