<?php

namespace App\Http\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class DaftarAntrianBukanSekarang extends Component
{

    public function render() : View
    {
        $data = d_antrian_satker::where('konsumen_email', session('konsumen_email'))
                    ->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'))
                    ->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'))
                    ->get();
        return view('livewire.antrian.non-admin.component.daftar_antrian_bukan_sekarang', ['data' => $data]);
    }

}
