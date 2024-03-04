<?php

namespace App\Http\Livewire\Antrian\NonAdmin;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class LihatAntrian extends Component
{

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('antrian-non-admin-lihat'),
            'label' => 'Daftar Antrian Pribadi'
        ];
    }

    public function render() : View
    {
        return view('livewire.antrian.non-admin.lihat_antrian')->layout('layouts.app_antrian');
    }

}
