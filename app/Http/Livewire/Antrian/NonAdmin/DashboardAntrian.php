<?php

namespace App\Http\Livewire\Antrian\NonAdmin;

use App\Models\d_antrian_satker;
use App\Models\m_antrian_satker_layanan;
use App\Models\m_satker;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DashboardAntrian extends Component
{

    public function render() : View
    {
        return view('livewire.antrian.non-admin.dashboard', ['satu' => 'satu']) -> layout('layouts.auth_antrian');
    }



    private function retrieveData_satker_have_layanan_active()
    {
        $arr_kode_satker_active = collect(m_antrian_satker_layanan::where('is_active', '1')->get())->pluck('kode_satker')->toArray();
        return m_satker::whereIn('kode_satker', $arr_kode_satker_active)->get();
    }
    
    private function retrieveData_satker($kode_satker)
    {
        $arr_kode_layanan_active = collect(m_antrian_satker_layanan::where('kode_satker', $kode_satker)->where('is_active', '1')->get())->pluck('kode_layanan')->toArray();
        return d_antrian_satker::where('kode_satker', $kode_satker)
            ->whereDate('tanggal', Carbon::today())
            ->whereIn('kode_layanan', $arr_kode_layanan_active)
            ->get();
    }

}
