<?php

namespace App\Http\Livewire\Setting\Officer;

use App\Models\m_pengguna;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lists extends Component
{
    public $operators;

    public function mount()
    {
        $this->operators = Auth::user()->role_id === 1
            ? m_pengguna::where('role_id', 7)->get()
            : m_pengguna::where('kode_satker_id', Auth::user()->kode_satker_id)
                        ->where('role_id', 7)
                        ->get();
    }

    public function render()
    {
        return view('livewire.setting.officer.lists');
    }

    public function update(m_pengguna $data, $val)
    {
        $data->update(['aktif' => $val]);

        session()->flash('message', $val == 0 ? 'Operator telah dinonaktifkan.' : 'Operator telah diaktifkan.');

        return redirect(env('APP_URL') . '/setting/officer/lists');
    }
}
