<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\m_layanan;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    #[Validate('required', onUpdate: false, message: 'Kode layanan tidak boleh kosong')]
    #[Validate('numeric', onUpdate: false, message: 'Kode layanan hanya boleh numerik')]
    public string $f_kode;

    #[Validate('required', onUpdate: false, message: 'Nama layanan tidak boleh kosong')]
    #[Validate('min:5', onUpdate: false, message: 'Nama layanan minimal 5 huruf')]
    public string $f_nama;

    #[Validate('nullable', onUpdate: false)]
    #[Validate('min:5', onUpdate: false, message: 'Deskripsi layanan minimal 5 huruf')]
    public ?string $f_deskripsi;

    #[Validate('required', onUpdate: false, message: 'Metode layanan harus terpilih salah satu')]
    public string $f_metode;

    public function save(): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            m_layanan::create([
                'kode_layanan' => $this->f_kode,
                'nama_layanan' => $this->f_nama,
                'deskripsi'    => $this->f_deskripsi ?? null,
                'metode'       => $this->f_metode
            ]);

            DB::commit();

            $message = "Informasi layanan telah disimpan";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi layanan gagal disimpan";
        }

        return $message;
    }

    public function update(m_layanan $layanan): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $layanan->update([
                'kode_layanan' => $this->f_kode,
                'nama_layanan' => $this->f_nama,
                'deskripsi'    => $this->f_deskripsi ?? null,
                'metode'       => $this->f_metode
            ]);

            DB::commit();

            $message = "Informasi layanan telah diperbaharui";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi layanan gagal diperbaharui";
        }

        return $message;
    }
}
