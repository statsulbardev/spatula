<?php

namespace App\Traits;

use App\Models\d_penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

trait HasReportProperty
{
    public function initMonthsOption() : array
    {
        return [
            ['1', 'Januari'],
            ['2', 'Februari'],
            ['3', 'Maret'],
            ['4', 'April'],
            ['5', 'Mei'],
            ['6', 'Juni'],
            ['7', 'Juli'],
            ['8', 'Agustus'],
            ['9', 'September'],
            ['10', 'Oktober'],
            ['11', 'November'],
            ['12', 'Desember']
        ];
    }

    public function initYearsOption() : Collection
    {
        return d_penilaian::query()
                -> select(DB::Raw('YEAR(created_at) as year'))
                -> distinct()
                -> pluck('year');
    }
}
