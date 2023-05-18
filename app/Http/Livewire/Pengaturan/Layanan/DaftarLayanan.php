<?php

namespace App\Http\Livewire\Pengaturan\Layanan;

use App\Models\m_layanan;
use App\Traits\HasModelProcess;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarLayanan extends Component
{
    use HasModelProcess, WithPagination;

    public m_layanan $layanan;
    public int $numberOfPagination = 10;

    public function render() : View
    {
        return view('livewire.pengaturan.layanan.daftar-layanan', [
            'services' => m_layanan::query()
                            -> orderBy('id', 'asc')
                            -> paginate($this->numberOfPagination)
        ])->layout('layouts.app');
    }

    // reset pagination
    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_layanan $layanan)
    {
        $this->layanan = $layanan;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->layanan);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }
}
