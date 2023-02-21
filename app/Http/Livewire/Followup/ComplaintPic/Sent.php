<?php

namespace App\Http\Livewire\Followup\ComplaintPic;

use App\Models\d_penilaian;
use Livewire\Component;

class Sent extends Component
{
    public $customer;
    public $comment;
    public $button;

    public function mount(d_penilaian $id)
    {
        $this->customer = $id;
    }

    public function render()
    {
        return view('livewire.followup.complaint-pic.sent')
            ->layout('layouts.app');
    }

    public function switch($val)
    {
        $this->button = $val;
    }

    public function store()
    {
        switch($this->button)
        {
            case 'whatsapp':
                break;
            case 'email':
                break;
        }
    }
}
