<?php

namespace App\Http\Livewire\Pengaturan\Petugas;

use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\UnitCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPetugas extends Component
{
    use UnitCode, WithPagination;

    public $officers;
    public $selectedUnit;
    public $units;

    public function render()
    {
        return view('livewire.pengaturan.petugas.daftar-petugas')
            -> layout('layouts.app');
    }

    public function mount()
    {
        $this->units = m_satker::get();

        $this->officers = Auth::user()->hasRole('superadmin')
            ? m_pengguna::role('operator')->orderBy('aktif', 'desc')->get()
            : m_pengguna::role('operator')
                        ->where('kode_satker_id', Auth::user()->kode_satker_id)
                        ->get();
    }

    public function update(m_pengguna $data, $val)
    {
        $val == 0 ? $data->update(['aktif' => 1]) : $data->update(['aktif' => 0]);

        session()->flash('message', $val == 0 ? 'Petugas telah dinonaktifkan.' : 'Petugas telah diaktifkan.');

        return redirect(env('APP_URL') . '/pengaturan/petugas');
    }

    public function updatedSelectedUnit()
    {
        $this->officers = m_pengguna::role('operator')
                                    ->where('kode_satker_id', $this->selectedUnit)
                                    ->orderBy('aktif', 'desc')
                                    ->get();
    }

    public function resetTable()
    {
        $this->officers = Auth::user()->hasRole('superadmin')
            ? m_pengguna::role('operator')->orderBy('aktif', 'desc')->get()
            : m_pengguna::role('operator')
                        ->where('kode_satker_id', Auth::user()->kode_satker_id)
                        ->get();
    }
}
