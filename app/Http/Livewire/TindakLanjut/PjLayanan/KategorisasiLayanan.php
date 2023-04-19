<?php

namespace App\Http\Livewire\TindakLanjut\PjLayanan;

use App\Models\d_penilaian;
use Carbon\Carbon;
use Livewire\Component;

class KategorisasiLayanan extends Component
{
    public $customer;

    public $poin = [];

    public function mount(d_penilaian $id)
    {
        $this->customer = $id;
    }

    public function render()
    {
        return view('livewire.tindak-lanjut.pj-layanan.kategorisasi-layanan')
            -> layout('layouts.app');
    }

    public function save()
    {
        $data = [
            $this->suggest ? 1 : null,
            $this->complaint ? 2 : null,
            $this->criticism ? 3 : null,
            $this->appreciation ? 4 : null,
            $this->other ? 9 : null,
        ];

        if (count(array_filter($data)) === 0) return redirect()->back();

        $this->complaint
              ? $this->customer->update([
                    'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                    'is_pengaduan' => 1,
                    'tanggal_kategorisasi' => Carbon::now()
                ])
              : $this->customer->update([
                    'kode_saran'   => array_values(array_filter($data)), // remove null values and reindex
                    'is_pengaduan' => 0,
                    'tanggal_kategorisasi' => Carbon::now()
                ]);

        session()->flash('message', 'Kategorisasi telah disimpan.');

        return redirect(env('APP_URL') . '/followup/service/lists');
    }
}
