<?php

namespace App\Http\Livewire\TindakLanjut\PjPengaduan;

use App\Models\d_penilaian;
use App\Traits\HasModelProcess;
use App\Traits\UnitCode;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class DaftarPjPengaduan extends Component
{
    use HasModelProcess, UnitCode, WithPagination;

    public int $numberOfPagination = 10;

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-pengaduan.daftar-pj-pengaduan', [
            'complaints' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function finalize(d_penilaian $penilaian)
    {
        $result = $this->customUpdate($penilaian, [
                    'selesai' => 1,
                    'tanggal_selesai' => Carbon::now()
                ]);

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }

    private function retrieveData() : Paginator
    {
        $result = auth()->user()->hasRole('superadmin')
            ? d_penilaian::query()
                -> where('selesai', 0)
                -> where('is_pengaduan', 1)
                -> paginate($this->numberOfPagination)
            : d_penilaian::query()
                -> where('selesai', 0)
                -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                -> where('is_pengaduan', 1)
                -> paginate($this->numberOfPagination);

        return $result;
    }
}
