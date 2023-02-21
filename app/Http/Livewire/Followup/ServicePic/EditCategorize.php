<?php

namespace App\Http\Livewire\Followup\ServicePic;

use App\Models\d_penilaian;
use Carbon\Carbon;
use Livewire\Component;

class EditCategorize extends Component
{
    public $customer;

    public $suggest;
    public $complaint;
    public $criticism;
    public $appreciation;
    public $other;

    public function mount(d_penilaian $id)
    {
        $this->customer = $id;

        $this->suggest      = in_array(1, $id->kode_saran) ?? false;
        $this->complaint    = in_array(2, $id->kode_saran) ?? false;
        $this->criticism    = in_array(3, $id->kode_saran) ?? false;
        $this->appreciation = in_array(4, $id->kode_saran) ?? false;
        $this->other        = in_array(9, $id->kode_saran) ?? false;
    }

    public function render()
    {
        return view('livewire.followup.service-pic.edit-categorize')
            -> layout('layouts.app');
    }

    public function update()
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

        session()->flash('message', 'Kategorisasi telah diperbaharui.');

        return redirect(env('APP_URL') . 'followup/service/lists');
    }
}
