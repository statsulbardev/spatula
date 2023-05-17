<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use App\Traits\HasModelProcess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSatker extends Component
{
    use HasModelProcess, WithPagination;

    public int $numberOfPagination = 10;

    public function render() : View
    {
        return view('livewire.pengaturan.satker.daftar-satker', [
            'offices' => m_satker::paginate($this->numberOfPagination)
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_satker $satker)
    {
        $result = $this->delete($satker);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }
}
