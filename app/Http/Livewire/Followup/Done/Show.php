<?php

namespace App\Http\Livewire\Followup\Done;

use App\Models\d_penilaian;
use Livewire\Component;

class Show extends Component
{
    public $done;

    public function mount(d_penilaian $id)
    {
        $this->done = $id;
    }

    public function render()
    {
        return view('livewire.followup.done.show');
    }
}
