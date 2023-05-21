<?php

namespace App\Http\Livewire\Formulir;

use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Repositories\PenilaianRepository;
use App\Traits\HasRenderOption;
use Illuminate\View\View;
use Livewire\Component;

class Penilaian extends Component
{
    use HasRenderOption;

    // Master Data
    public $units;
    public $services;
    public $officers;

    // Form Data
    public $f_unit;
    public $f_nama;
    public $f_email;
    public $f_nowatelp;
    public $f_layanan;
    public $f_ratinglayanan;
    public $f_petugas;
    public $f_ratingpetugas;
    public $f_saranpengaduan;

    public function render() : View
    {
        return view('livewire.formulir.penilaian')
            -> layout('layouts.evaluation');
    }

    public function mount()
    {
        $this->units = $this->renderOption(
                            m_satker::get(['kode_satker', 'nama'])
                            -> map(function($item) {
                                return [
                                    0 => json_encode($item->kode_satker . '-' . $item->nama),
                                    1 => $item->nama
                                ];
                            })
                            -> toArray()
                        );

        $this->services = $this->renderOption(
                            m_layanan::get(['kode_layanan', 'nama_layanan', 'metode'])
                            -> map(function($item) {
                                return [
                                    0 => json_encode($item->kode_layanan . '-' . $item->metode),
                                    1 => $item->nama_layanan
                                ];
                            })
                            -> toArray()
                          );

        $this->officers = $this->renderOption(
                            m_pengguna::role('operator')
                                -> where('is_petugas', 1)
                                -> get(['id', 'nama'])
                                -> map(function($item) {
                                    return [
                                        0 => $item->id,
                                        1 => $item->nama
                                    ];
                                })
                                -> toArray()
                          );
    }

    public function storeData(PenilaianRepository $penilaianRepository)
    {
        $this->emit('saved');

        $this->validate();

        $result = $penilaianRepository->store($this);

        session()->flash('messages', $result);

        return redirect(env('APP_URL') . '/penilaian');
    }

    public function resetData()
    {
        $this->resetErrorBag();

        $this->resetExcept(['officers', 'services', 'units']);
    }

    public function updatedFLayanan()
    {
        $temp = explode('-', $this->f_layanan)[1];

        $this->dispatchBrowserEvent('contentChanged');

        if ($temp == 2)
            $this->reset(['f_petugas', 'f_ratingpetugas']);
    }

    protected function rules() : array
    {
        return [
            'f_unit'           => 'required',
            'f_nama'           => 'required|min:4|max:30',
            'f_email'          => 'nullable|email:rfc,dns',
            'f_nowatelp'       => 'required|numeric',
            'f_layanan'        => 'required',
            'f_ratinglayanan'  => 'required',
            'f_petugas'        => 'required_if:f_layanan,1',
            'f_ratingpetugas'  => 'required_if:f_layanan,1',
            'f_saranpengaduan' => 'required|min:4'
        ];
    }

    protected $messages = [
        'f_unit.required'             => 'Unit kerja harus terpilih salah satu',
        'f_nama.required'             => 'Nama tidak boleh kosong',
        'f_nama.min'                  => 'Nama sekurang-kurangnya 4 karakter',
        'f_nama.max'                  => 'Nama maksimal sebanyak 30 karakter',
        'f_email.email'               => 'Format email tidak valid',
        'f_nowatelp.required'         => 'Nomor telp/whatsapp tidak boleh kosong',
        'f_nowatelp.numeric'          => 'Nomor telp/whatsapp hanya boleh angka',
        'f_layanan.required'          => 'Jenis layanan minimal terpilih salah satu',
        'f_ratinglayanan.required'    => 'Rating layanan harus terpilih salah satu',
        'f_petugas.required_if'       => 'Petugas layanan minimal terpilih salah satu',
        'f_ratingpetugas.required_if' => 'Rating petugas layanan minimal terpilih salah satu',
        'f_saranpengaduan.required'   => 'Saran Pengaduan tidak boleh kosong',
        'f_saranpengaduan.min'        => 'Saran Pengaduan sekurang-kurangnya terisi 4 karakter'
    ];
}
