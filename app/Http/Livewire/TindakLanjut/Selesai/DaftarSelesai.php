<?php

namespace App\Http\Livewire\TindakLanjut\Selesai;

use App\Models\d_penilaian;
use App\Traits\UnitCode;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSelesai extends Component
{
    use UnitCode, WithPagination;

    public int $numberOfPagination = 10;

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
            ? d_penilaian::query()
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
                -> paginate($this->numberOfPagination)
            : d_penilaian::query()
                -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                -> where('selesai', 1)
                -> orderBy('tanggal_selesai', 'desc')
                -> paginate($this->numberOfPagination);

        return $result;
    }
}
