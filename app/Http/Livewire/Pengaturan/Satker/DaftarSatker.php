<?php

namespace App\Http\Livewire\Pengaturan\Satker;

use App\Models\m_satker;
use App\Traits\HasModelProcess;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSatker extends Component
{
    use HasModelProcess, WithPagination;

    public m_satker $satker;
    public int $numberOfPagination = 10;

    public function render() : View
    {
        return view('livewire.pengaturan.satker.daftar-satker', [
            'offices' => m_satker::query()
                            -> orderBy('kode_satker', 'asc')
                            -> paginate($this->numberOfPagination)
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_satker $satker)
    {
        $this->satker = $satker;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->satker);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }
}
