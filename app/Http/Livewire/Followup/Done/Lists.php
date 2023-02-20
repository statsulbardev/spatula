<?php

namespace App\Http\Livewire\Followup\Done;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    use UnitCode;

    public $dones;

    public function mount()
    {
        $this->dones = Auth::user()->role_id === 1
            ? d_penilaian::where('selesai', 1)->orderBy('tanggal_selesai', 'desc')->get()
            : d_penilaian::where('kode_satker_id', $this->getUnitCode()->kode_satker)
                         ->where('selesai', 1)
                         ->orderBy('tanggal_selesai', 'desc')
                         ->get();
    }

    public function render()
    {
        return view('livewire.followup.done.lists')
            -> layout('layouts.app');
    }
}
