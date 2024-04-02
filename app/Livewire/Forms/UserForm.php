<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\m_pengguna;
use App\Models\m_satker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required', onUpdate: false, message: 'Nama pegawai tidak boleh kosong')]
    #[Validate('min:4', onUpdate: false, message: 'Nama pegawai minimal empat huruf')]
    public string $f_nama;

    #[Validate('required', onUpdate: false, message: 'Email tidak boleh kosong')]
    #[Validate('email:rfc', onUpdate: false, message: 'Format email tidak sesuai')]
    public string $f_email;

    public string $f_password;

    #[Validate('required', onUpdate: false, message: 'NIP pegawai tidak boleh kosong')]
    #[Validate('numeric', onUpdate: false, message: 'NIP hanya boleh karakter numerik')]
    public string $f_nip;

    #[Validate('required', onUpdate: false, message: 'Tipe petugas harus terpilih')]
    public int $f_petugas;

    #[Validate('required', onUpdate: false, message: 'Role harus terpilih minimal satu')]
    public array $f_role;

    #[Validate('required', onUpdate: false, message: 'Satker pegawai harus terpilih')]
    public string $f_unit;

    public function save(): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $query = m_pengguna::create([
                'nama'           => $this->f_nama,
                'username'       => explode('@', $this->f_email)[0],
                'email'          => $this->f_email,
                'password'       => bcrypt($this->f_password),
                'bpsid'          => $this->f_nip,
                'kode_satker_id' => $this->f_unit ?? auth()->user()->satker->kode_satker,
                'is_petugas'     => $this->f_petugas
            ]);

            $query->assignRole($this->f_role);

            DB::commit();

            $message = "Informasi pengguna telah disimpan";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi pengguna gagal disimpan";
        }

        return $message;
    }

    public function update(m_pengguna $pengguna): string
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $pengguna->update([
                'nama'           => $this->f_nama,
                'username'       => explode('@', $this->f_email)[0],
                'email'          => $this->f_email,
                'password'       => empty($this->f_password) ? $pengguna->getOriginal('password') : bcrypt($this->f_password),
                'bpsid'          => $this->f_nip,
                'kode_satker_id' => $this->f_unit,
                'is_petugas'     => $this->f_petugas
            ]);

            $pengguna->syncRoles($this->f_role);

            DB::commit();

            $message = "Informasi pengguna telah diperbaharui";
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $message = "Informasi pengguna gagal diperbaharui";
        }

        return $message;
    }

    public function retrieveUnits(): array
    {
        return m_satker::get(['kode_satker', 'nama'])
                -> map(function($item) {
                    return [
                        0 => $item->kode_satker,
                        1 => $item->nama
                    ];
                })->toArray();
    }
}
