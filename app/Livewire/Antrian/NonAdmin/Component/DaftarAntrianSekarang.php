<?php

namespace App\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use Illuminate\View\View;
use Livewire\Component;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\LivewireComponentsFinder;

class DaftarAntrianSekarang extends Component
{

    public function render() : View
    {
        Log::info('asasasasasasasasa asasasasas');
        $data = d_antrian_satker::with(['satker', 'layanan'])
                    ->where('konsumen_email', session('konsumen_email'))
                    ->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'))
                    ->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'))
                    ->whereDate('tanggal', Carbon::today())
                    ->get();
        return view('livewire.antrian.non-admin.component.daftar_antrian_sekarang', ['data' => $data]);
    }

}
