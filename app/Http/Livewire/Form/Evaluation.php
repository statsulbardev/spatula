<?php

namespace App\Http\Livewire\Form;

use App\Http\Requests\StoreEvaluationRequest;
use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Models\m_satker;
use App\Traits\HasRenderOption;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class Evaluation extends Component
{
    use HasRenderOption;

    public ?string $officers;
    protected StoreEvaluationRequest $ruleValidation;

    /** @props */
    public $f_unit;
    public $f_nama;
    public $f_email;
    public $f_nowatelp;
    public $f_layanan;
    public $f_ratinglayanan;
    public $f_petugas;
    public $f_ratingpetugas;
    public $f_saranpengaduan;

    /** @computed property : units */
    public function getUnitsProperty(): string
    {
        return
            $this->renderOption(
                m_satker::get(['kode_satker', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => json_encode($item->kode_satker . '-' . $item->nama),
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );
    }

    // Computed Property : services
    public function getServicesProperty(): string
    {
        return
            $this->renderOption(
                m_layanan::get(['kode_layanan', 'nama_layanan', 'metode'])
                    ->map(function ($item) {
                        return [
                            0 => json_encode($item->kode_layanan . '-' . $item->metode),
                            1 => $item->nama_layanan
                        ];
                    })
                    ->toArray()
            );
    }

    public function mount()
    {
        $this->ruleValidation = new StoreEvaluationRequest();
    }

    public function render(): View
    {
        return view('livewire.form.evaluation')->layout('layouts.evaluation');
    }

    public function submitData()
    {
        $this->emit('saved');

        $this->validate();

        try {

            DB::beginTransaction();

            d_penilaian::create([
                'nama_konsumen'   => $this->f_nama,
                'email_konsumen'  => $this->f_email,
                'no_wa_telepon'   => $this->f_nowatelp,
                'kode_satker_id'  => explode('-', $this->f_unit)[0],
                'kode_layanan'    => explode('-', $this->f_layanan)[0],
                'rating_layanan'  => $this->f_ratinglayanan,
                'kode_petugas'    => $this->f_petugas ?? null,
                'rating_petugas'  => $this->f_ratingpetugas ?? null,
                'saran_pengaduan' => $this->f_saranpengaduan,
                'selesai'         => false
            ]);

            DB::commit();

            $message = "Terima kasih telah memberikan penilaian..";

            $this->dispatchBrowserEvent('notification', ['message' => $message]);
        } catch (Exception $error) {
            DB::rollBack();

            Log::alert($error->getMessage());
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
                    ->where('kode_satker_id', explode('-', $this->f_unit)[0])
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

        $this->reset(['f_layanan', 'f_ratinglayanan', 'f_petugas', 'f_ratingpetugas']);
    }

    public function updatedFLayanan()
    {
        $temp = explode('-', $this->f_layanan)[1];

        $this->dispatchBrowserEvent('contentChanged');

        if ($temp == 2)
            $this->reset(['f_petugas', 'f_ratingpetugas']);
    }

    protected function rules(): array
    {
        return ($this->ruleValidation)->rules();
    }

    protected function messages(): array
    {
        return ($this->ruleValidation)->messages();
    }
}
