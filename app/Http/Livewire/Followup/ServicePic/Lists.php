<?php

namespace App\Http\Livewire\Followup\ServicePic;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    use UnitCode;

    public $services;

    public function mount()
    {
        $this->services = Auth::user()->role_id === 1
            ? d_penilaian::where('selesai', 0)->get()
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 0)
                         ->get();
    }

    public function render()
    {
        return view('livewire.followup.service-pic.lists');
    }
}
