<?php

namespace App\Http\Livewire\Pengaturan\Petugas;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\UnitCode;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPetugas extends Component
{
    use UnitCode, WithPagination;

    public m_pengguna $petugas;
    public int $numberOfPagination = 10;
    public ?string $searchKeyword = null;

    public $selectedUnit;
    public $units;

    public function render()
    {
        return view('livewire.pengaturan.petugas.daftar-petugas', [
            'officers' => $this->retrieveData()
        ])->layout('layouts.app');
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    // public function update(m_pengguna $data, $val)
    // {
    //     $val == 0 ? $data->update(['aktif' => 1]) : $data->update(['aktif' => 0]);

    //     session()->flash('message', $val == 0 ? 'Petugas telah dinonaktifkan.' : 'Petugas telah diaktifkan.');

    //     return redirect(env('APP_URL') . '/pengaturan/petugas');
    // }

    // public function updatedSelectedUnit()
    // {
    //     $this->officers = m_pengguna::role('operator')
    //                                 ->where('kode_satker_id', $this->selectedUnit)
    //                                 ->orderBy('aktif', 'desc')
    //                                 ->get();
    // }

    // public function resetTable()
    // {
    //     $this->officers = Auth::user()->hasRole('superadmin')
    //         ? m_pengguna::role('operator')->orderBy('aktif', 'desc')->get()
    //         : m_pengguna::role('operator')
    //                     ->where('kode_satker_id', Auth::user()->kode_satker_id)
    //                     ->get();
    // }

    private function retrieveData() : Paginator
    {
        $role = ['pj-layanan', 'pj-pengaduan', 'operator'];

        $result = auth()->user()->hasRole('superadmin')
            ? m_pengguna::search($this->searchKeyword)
                -> query(function (Builder $query) use ($role) {
                    $query
                        -> where('is_petugas', 1)
                        -> whereHas('roles', function (Builder $query) use ($role) {
                            $query->whereIn('name', $role);
                        });
                })
                -> orderBy('kode_satker_id', 'asc')
            : m_pengguna::search($this->searchKeyword)
                -> role('operator')
                -> where('kode_satker_id', auth()->user()->kode_satker_id);

        return $result->paginate($this->numberOfPagination);
    }
}
