<?php

namespace App\Traits;

use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_saran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

trait HasInitialProperty
{
    public function initMonthsOption(): array
    {
        return [
            ['1' => 'Januari'],
            ['2' => 'Februari'],
            ['3' => 'Maret'],
            ['4' => 'April'],
            ['5' => 'Mei'],
            ['6' => 'Juni'],
            ['7' => 'Juli'],
            ['8' => 'Agustus'],
            ['9' => 'September'],
            ['10' => 'Oktober'],
            ['11' => 'November'],
            ['12' => 'Desember']
        ];
    }

    public function initOfficersOption(): array
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        return
            m_pengguna::query()
            ->when(!$superadmin_role, function (Builder $query, $data) use ($user_unit_code) {
                $query->where('kode_satker_id', $user_unit_code);
            })
            ->get(['id', 'nama', 'email'])
            ->map(function ($item) {
                return [
                    $item->id => [
                        'nama'  => $item->nama,
                        'email' => $item->email
                    ]
                ];
            })
            ->toArray();
    }

    public function initServicesOption(): array
    {
        return
            m_layanan::query()
            ->get(['kode_layanan', 'nama_layanan'])
            ->map(function ($item) {
                return [
                    $item->kode_layanan => $item->nama_layanan
                ];
            })
            ->toArray();
    }

    public function initYearsOption(): Collection
    {
        return d_penilaian::query()
            ->select(DB::Raw('YEAR(created_at) as year'))
            ->distinct()
            ->pluck('year');
    }

    public function initSuggestionsOption(): array
    {
        return
            m_saran::query()
            ->get(['kode_saran', 'nama_saran'])
            ->map(function ($item) {
                return [
                    $item->kode_saran => $item->nama_saran
                ];
            })
            ->toArray();
    }

    public function initColorSuggestionsOption(): array
    {
        return [
            ['1' => 'violet'],
            ['2' => 'cyan'],
            ['3' => 'rose'],
            ['4' => 'green'],
            ['9' => 'zinc']
        ];
    }
}
