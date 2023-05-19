<?php

namespace App\Http\Livewire\TindakLanjut\Selesai;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSelesai extends Component
{
    use UnitCode, WithPagination;

    public int $numberOfPagination = 10;
    public ?string $searchKeyword = null;

    public function render()
    {
        return view('livewire.tindak-lanjut.selesai.daftar-selesai', [
            'dones' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    private function retrieveData() : Paginator
    {
        $result = auth()->user()->hasRole('superadmin')
            ? d_penilaian::search($this->searchKeyword)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
            : d_penilaian::search($this->searchKeyword)
                -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc');

        return $result->paginate($this->numberOfPagination);
    }
}
