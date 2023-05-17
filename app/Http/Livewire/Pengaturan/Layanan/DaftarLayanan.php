<?php

namespace App\Http\Livewire\Pengaturan\Layanan;

use App\Models\m_layanan;
use App\Traits\HasModelProcess;
use Exception;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarLayanan extends Component
{
    use HasModelProcess, WithPagination;

    public int $numberOfPagination = 10;

    public function render() : View
    {
        return view('livewire.pengaturan.layanan.daftar-layanan', [
            'services' => m_layanan::paginate($this->numberOfPagination)
        ])->layout('layouts.app');
    }

    // reset pagination
    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_layanan $layanan)
    {
        $result = $this->delete($layanan);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }
}
