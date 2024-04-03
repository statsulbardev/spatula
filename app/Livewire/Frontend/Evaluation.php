<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\HasRenderOption;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Evaluation extends Component
{
    use HasRenderOption;

    // protected StoreEvaluationRequest $ruleValidation;

    public ?string $officers;

    public $unitServices;

    #[Validate('required', onUpdate: false, message: 'Isian satker tidak boleh kosong')]
    public string $f_unit;

    #[Validate('required', onUpdate: false, message: 'Nama penerima layanan tidak boleh kosong')]
    #[Validate('min:5', onUpdate: false, message: 'Nama penerima layanan minimal lima huruf')]
    public string $f_nama;

    #[Validate('nullable')]
    #[Validate('email:rfc', onUpdate: false, message: 'Format email tidak benar')]
    public string $f_email;

    #[Validate('required', onUpdate: false, message: 'Isian nomor telepon/whatsapp harus terisi')]
    #[Validate('numeric', onUpdate: false, message: 'Isian hanya boleh numerik')]
    public string $f_nowatelp;

    #[Validate('required', onUpdate: false, message: 'Isian layanan harus terisi')]
    public string $f_layanan;

    #[Validate('required', onUpdate: false, message: 'Rating layanan harus terisi')]
    public string $f_ratinglayanan;

    //TODO: Lihat StoreEvaluationRequest
    public string $f_petugas;

    //TODO: Lihat StoreEvaluationRequest
    public string $f_ratingpetugas;

    #[Validate('min:5', onUpdate: false, message: 'Deskripsi saran pengaduan minimal 5 karakter')]
    public string $f_saranpengaduan;

    #[Computed]
    public function units(): string
    {
        return
            $this->renderOption(
                m_satker::get(['id', 'kode_satker', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => json_encode($item->id . '-' . $item->kode_satker . '-' . $item->nama),
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );
    }

    #[Title('Form Penilaian Spatula')]
    public function render(): View
    {
        return view('livewire.frontend.evaluation')
            ->layout('components.layouts.evaluation');
    }

    public function submitData()
    {
        $this->dispatch('validate');

        $this->validate();

        try {
            DB::beginTransaction();

            d_penilaian::create([
                'nama_konsumen'   => $this->f_nama,
                'email_konsumen'  => $this->f_email,
                'no_wa_telepon'   => $this->f_nowatelp,
                'kode_satker_id'  => explode('-', $this->f_unit)[1],
                'kode_layanan'    => explode('-', $this->f_layanan)[0],
                'rating_layanan'  => $this->f_ratinglayanan,
                'kode_petugas'    => $this->f_petugas ?? null,
                'rating_petugas'  => $this->f_ratingpetugas ?? null,
                'saran_pengaduan' => $this->f_saranpengaduan,
                'selesai'         => false
            ]);

            DB::commit();

            $this->dispatch('notification_evaluasi');

        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $this->dispatch('notification_evaluasi', message: 'Maaf terjadi kesalahan, silahkan hubungi tim layanan kami');
        }

        $this->resetExcept(['officers', 'services', 'units', 'message']);
    }

    public function resetData()
    {
        $this->resetErrorBag();

        $this->resetExcept(['officers', 'services', 'units']);
    }

    public function updatedFUnit()
    {
        $this->officers =
            $this->renderOption(
                m_pengguna::query()
                    ->where('kode_satker_id', explode('-', $this->f_unit)[1])
                    ->where('is_petugas', 1)
                    ->get(['id', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => $item->id,
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );

        $this->unitServices =
            $this->renderOption(
                DB::table('m_layanan')
                    ->join('m_satker_layanan', 'm_layanan.id', '=', 'm_satker_layanan.m_layanan_id')
                    ->where('m_satker_layanan.m_satker_id', explode('-', $this->f_unit)[0])
                    ->select('m_layanan.kode_layanan', 'm_layanan.nama_layanan', 'm_layanan.metode')
                    ->get()
                    ->map(function ($item) {
                        return [
                            0 => json_encode($item->kode_layanan . '-' . $item->metode),
                            1 => $item->nama_layanan
                        ];
                    })
                    ->toArray()
            );

        $this->reset(['f_layanan', 'f_ratinglayanan', 'f_petugas', 'f_ratingpetugas']);
    }

    public function updatedFLayanan()
    {
        $temp = explode('-', $this->f_layanan)[1];

        // $this->dispatch('contentChanged');

        if ($temp == 2)
            $this->reset(['f_petugas', 'f_ratingpetugas']);
    }
}
