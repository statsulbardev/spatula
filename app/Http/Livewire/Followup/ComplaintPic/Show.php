<?php

namespace App\Http\Livewire\Followup\ComplaintPic;

use App\Models\d_penilaian;
use Livewire\Component;

class Show extends Component
{
    public $complaintDetail;

    public function mount(d_penilaian $id)
    {
        $this->complaintDetail = $id;
    }

    public function render()
    {
        return view('livewire.followup.complaint-pic.show')
            ->layout('layouts.app');
    }
}
