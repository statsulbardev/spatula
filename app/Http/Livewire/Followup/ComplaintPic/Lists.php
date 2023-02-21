<?php

namespace App\Http\Livewire\Followup\ComplaintPic;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    use UnitCode;

    public $complaints;

    public function mount()
    {

        if(Auth::user()->role_id === 1) {
            $this->complaints = d_penilaian::where('selesai', 0)
                                ->where('is_pengaduan', 1)
                                ->get();
        } else {
            $kodeSatker = $this->getSatkerKode();

            $this->complaints = d_penilaian::where('selesai', 0)
                                ->where('kode_satker_id', $kodeSatker->kode_satker)
                                ->where('is_pengaduan', 1)
                                ->get();
        }
    }

    public function render()
    {
        return view('livewire.followup.complaint-pic.lists')
            -> layout('layouts.app');
    }

    public function finalConfirmation($id)
    {
        $customer = d_penilaian::findOrFail($id);

        $customer->update([
            'selesai' => 1,
            'tanggal_selesai' => Carbon::now()
        ]);

        return redirect(url(env('APP_URL') . 'followup/complaint/lists'));
    }
}
