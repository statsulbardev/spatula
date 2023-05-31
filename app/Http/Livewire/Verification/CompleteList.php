<?php

namespace App\Http\Livewire\Verification;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompleteList extends Component
{
    use WithPagination;

    public function render() : View
    {
        return view('livewire.verification.complete-list')->layout('layouts.app');
    }
}
