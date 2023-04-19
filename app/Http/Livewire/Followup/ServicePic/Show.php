<?php

namespace App\Http\Livewire\Followup\ServicePic;

use App\Models\d_penilaian;
use Livewire\Component;

class Show extends Component
{
    public $serviceDetail;

    public function mount(d_penilaian $id)
    {
        $this->serviceDetail = $id;
    }

    public function render()
    {
        return view('livewire.followup.service-pic.show');
    }
}
