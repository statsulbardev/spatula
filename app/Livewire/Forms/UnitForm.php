<?php

namespace App\Livewire\Forms;

use App\Models\m_satker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

use function Laravel\Prompts\error;

class UnitForm extends Form
{
    #[Validate('required', onUpdate: false, message: 'Kode satker tidak boleh kosong')]
    #[Validate('min:4', onUpdate: false, message: 'Kode satker minimal empat digit')]
    public string $f_kode;

    #[Validate('required', onUpdate: false, message: 'Nama satker tidak boleh kosong')]
    #[Validate('min:3', onUpdate: false, message: 'Nama satker minimal 3 karakter')]
    public string $f_nama;

    #[Validate('required', onUpdate: false, message: 'Level satker harus terisi')]
    public string $f_level;

    #[Validate('nullable')]
    #[Validate('min:5', onUpdate: false, message: 'Alamat satker minimal lima karakter')]
    public string $f_alamat;

    #[Validate('nullable')]
    #[Validate('min:5', onUpdate: false, message: 'Website satker minimal lima karakter')]
    #[validate('max:30', onUpdate: false, message: 'Website satker maksimal tiga puluh karakter')]
    public string $f_web;

    #[Validate('nullable')]
    #[Validate('numeric', onUpdate: false, message: 'Telepon satker harus karakter numerik')]
    #[Validate('min:8', onUpdate: false, message: 'Telepon satker minimal terdiri dari delapan angka')]
    public string $f_telepon;

    public function save(): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            m_satker::create([
                'kode_satker' => $this->f_kode,
                'nama'        => $this->f_nama,
                'level'       => $this->f_level,
                'alamat'      => $this->f_alamat ?? null,
                'web'         => $this->f_web ?? null,
                'telepon'     => $this->f_telepon ?? null
            ]);

            DB::commit();

            $message = "Informasi satker telah disimpan";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi satker gagal disimpan";
        }

        return $message;
    }

    public function update(m_satker $satker): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $satker->update([
                'kode_satker' => $this->f_kode,
                'nama'        => $this->f_nama,
                'level'       => $this->f_level,
                'alamat'      => $this->f_alamat,
                'web'         => $this->f_web,
                'telepon'     => $this->f_telepon
            ]);

            DB::commit();

            $message = "Informasi satker telah diperbaharui";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi satker gagal diperbaharui";
        }

        return $message;
    }
}
