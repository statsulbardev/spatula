<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\Admin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Carbon\Carbon;

class DaftarAntrian extends Component
{
    public $tanggal_filter;

    public string $pageTitle = "Daftar Antrian";

    public function render(): View
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $master_antrian_satker = m_antrian_satker_layanan::all();
        $master_key_value = [];
        foreach($master_antrian_satker as $item){
            $master_key_value[$item->kode_satker.'--'.$item->kode_layanan] = $item->loket;
        }

        $data_to_render = [];
        if($this->tanggal_filter){
            $data_to_render = d_antrian_satker::with(['satker', 'layanan'])
                ->where('tanggal', $this->tanggal_filter)
                ->when(!$superadmin_role, function (Builder $query, $data) use ($user_unit_code) {
                    $query->where('kode_satker', $user_unit_code);
                })
                ->orderby('antrian', 'asc')
                ->get();
        }

        return view('livewire.antrian.admin.daftar-antrian', [
            'data' => $data_to_render, 'master_key_value' => $master_key_value, 'today_tanggal' => Carbon::today()->format('Y-m-d')
        ])
        ->layout('components.layouts.app')
        ->title($this->pageTitle);
    }


}
