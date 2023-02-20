<?php

namespace App\Http\Livewire\Followup\ComplaintPic;

use Livewire\Component;

class Lists extends Component
{
    public function render()
    {
        return view('livewire.followup.complaint-pic.lists')
            -> layout('layouts.app');
    }
}
