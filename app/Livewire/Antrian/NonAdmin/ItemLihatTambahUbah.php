<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\NonAdmin;

use App\Models\d_antrian_satker;
use App\Models\d_antrian_satker_config_view;
use App\Models\m_antrian_satker_layanan;
use App\Models\m_satker;
use App\Traits\HasRenderOption;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Webpatser\Uuid\Uuid;

class ItemLihatTambahUbah extends Component
{
    use HasRenderOption;

    public d_antrian_satker $atrian_satker;
    public string $routeName;

    // Form Data
    public $f_kode_satker;
    public $f_kode_layanan;
    public $f_tanggal;
    public $f_periode;
    public $f_deskripsi;

    public ?string $layanan_satker;
    public ?string $disable_date;


    public function rules() : array
    {
        return [
            'f_kode_satker'   => 'required',
            'f_kode_layanan'  => 'required',
            'f_tanggal'       => 'required|date',
            'f_periode'       => 'required',
            'f_deskripsi'     => 'required|min:5'
        ];
    }

    public function messages() : array
    {
        return [
            'f_kode_satker.required'   => 'Unit tidak boleh kosong',
            'f_kode_layanan.required'  => 'Layanan tidak boleh kosong',
            'f_tanggal.required'       => 'Tanggal tidak boleh kosong',
            'f_tanggal.date'           => 'Tanggal tidak sesuai format',
            'f_periode.required'       => 'Periode harus terisi',
            'f_deskripsi.required'     => 'Deskripsi harus terisi',
            'f_deskripsi.min'          => 'Deskripsi minimal 5 karakter'
        ];
    }

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty()
    {
        return [
            'route' => route('antrian-non-admin-lihat'),
            'label' => 'Daftar Antrian Pribadi'
        ];
    }

    /** @computed property : firstBread */
    public function getFirstBreadcrumbProperty()
    {
        if($this->routeName === 'antrian-non-admin-item-edit')
        {
            return [
                'route' => route('antrian-non-admin-lihat'),
                'label' => 'Edit Antrian',
            ];
        }
        else if($this->routeName === 'antrian-non-admin-item-lihat')
        {
            return [
                'route' => route('antrian-non-admin-lihat'),
                'label' => 'Lihat Antrian',
            ];
        }
    }

    /** @computed property : secondBreadcrumb */
    public function getSecondBreadcrumbProperty() : string
    {
        return $this->routeName === 'antrian-non-admin-item-tambah'
                ? 'Tambah Antrian'
                : 'Tanggal '.Carbon::createFromFormat('Y-m-d', $this->atrian_satker->tanggal)->format('d/m/Y');
    }

    public function mount(d_antrian_satker $antrian_satker)
    {
        if(session('kode_satker_active', null))
        {
            $this->f_kode_satker = session('kode_satker_active', null);
            $this->updatedFKodeSatker();
        }

        $this->routeName      = Route::currentRouteName();
        $this->atrian_satker  = $antrian_satker;
        if ($this->routeName === 'antrian-non-admin-item-lihat' || $this->routeName === 'antrian-non-admin-item-edit') {
            $this->f_kode_satker = $antrian_satker->kode_satker;
            $satker_layanan = m_antrian_satker_layanan::where('kode_satker', $antrian_satker->kode_satker)
                                ->where('kode_layanan', $antrian_satker->kode_layanan)
                                ->first();
            $this->f_kode_layanan = $satker_layanan->kode_layanan.'-'.$satker_layanan->loket;
            $this->f_tanggal = $antrian_satker->tanggal;
            $this->f_periode = substr($antrian_satker->antrian, 0, 1);
            $this->f_deskripsi = $antrian_satker->deskripsi;
        }
    }


    public function getUnitsProperty(): string
    {
        return
            $this->renderOption(
                m_satker::get(['kode_satker', 'nama'])
                    ->map(function ($item) {
                        return [
                            0 => $item->kode_satker,
                            1 => $item->nama
                        ];
                    })
                    ->toArray()
            );
    }

    public function updatedFKodeSatker()
    {
        session(['kode_satker_active' => $this->f_kode_satker]);
        $this->layanan_satker =
            $this->renderOption(
                m_antrian_satker_layanan::with('layanan')
                    ->where('kode_satker', $this->f_kode_satker)
                    ->where('is_active', 1)
                    ->orderby('loket')
                    ->get()
                    ->map(function ($item) {
                        return [
                            0 => $item->kode_layanan.'-'.$item->loket,
                            1 => '[Loket '.$item->loket.'] '.$item->layanan->nama_layanan
                        ];
                    })
                    ->toArray()
            );

        $this->disable_date = '';
        $config_date = d_antrian_satker_config_view::where('config_key', 'tanggal_disabled')->first();
        if($config_date){
            $this->disable_date = $config_date->config_value;
        }
        $this->dispatch('tambah-antrian-change-kode-satker');
    }

    public function render(): View
    {
        return view('livewire.antrian.non-admin.item_lihat_tambah_ubah')
            ->layout('components.layouts.antrian-app');
    }

    public function submitData()
    {
        if($this->routeName == 'antrian-non-admin-item-lihat'){
            return;
        }

        // Event for error message notification in blade.
        $this->dispatch('saved');

        // Validate the field.
        $this->validate();

        if($this->f_tanggal){
            if(str_contains($this->f_tanggal, $this->disable_date)){
                $this->addError('f_tanggal', 'PST tidak buka pada tanggal tersebut');
                return;
            }
            $tanggal_carbon = Carbon::createFromFormat('Y-m-d', $this->f_tanggal);
            if( $tanggal_carbon->dayOfWeek == Carbon::SATURDAY || $tanggal_carbon->dayOfWeek == Carbon::SUNDAY){
                $this->addError('f_tanggal', 'Pelayanan tidak buka pada sabtu dan minggu');
                return;
            }

            if($tanggal_carbon < Carbon::today()){
                $this->addError('f_tanggal', 'Tanggal minimal adalah tanggal hari ini');
                return;
            }

            if(date_diff(Carbon::today(), $tanggal_carbon, true)->days > 14){
                $this->addError('f_tanggal', 'Tanggal maksimal 2 minggu kedepan');
                return;
            }
        }
        // Save data to database.
        $loket = explode('-', $this->f_kode_layanan)[1];
        $kode_layanan = explode('-', $this->f_kode_layanan)[0];

        $kode_layanan_with_same_loket = m_antrian_satker_layanan::where('loket', $loket)
            ->where('kode_satker', $this->f_kode_satker)->get()->pluck('kode_layanan');

        $latest_antrian_query = d_antrian_satker::query();
        $latest_antrian_query->where('tanggal', $this->f_tanggal);
        $latest_antrian_query->where('periode', $this->f_periode);
        $latest_antrian_query->whereIn('kode_layanan', $kode_layanan_with_same_loket);
        $latest_antrian_query->orderby('antrian', 'desc');
        $latest_antrian = $latest_antrian_query->first();

        $latest_number = 0;

        if($latest_antrian){
            $latest_number = intval(substr($latest_antrian->antrian,1));
        }
        $latest_number  += 1;
        $antrian_baru = str_pad($latest_number, 2, "0", STR_PAD_LEFT);

        $latest_antrian_internal_query = d_antrian_satker::query();
        $latest_antrian_internal_query->where('tanggal', $this->f_tanggal);
        $latest_antrian_internal_query->orderby('antrian_internal', 'desc');
        $latest_antrian_internal = $latest_antrian_internal_query->first();
        $antrian_internal_baru = 0;
        if($latest_antrian_internal){
            $antrian_internal_baru = intval($latest_antrian_internal->antrian_internal);
        }
        $antrian_internal_baru +=1;


        if($this->routeName == 'antrian-non-admin-item-tambah'){
            DB::beginTransaction();
            try{
                $baru = new d_antrian_satker();
                $baru->id = (string) Uuid::generate();
                $baru->kode_satker = $this->f_kode_satker;
                $baru->kode_layanan = $kode_layanan;
                $baru->konsumen_nama =  session('konsumen_nama', null);
                $baru->konsumen_tahun_lahir =  session('konsumen_tahun_lahir', null);
                $baru->tanggal = $this->f_tanggal;
                $baru->status = 0;
                $baru->periode = $this->f_periode;
                $baru->antrian = $this->f_periode.$antrian_baru;
                $baru->antrian_internal = $antrian_internal_baru;
                $baru->konsumen_email = session('konsumen_email', null);
                $baru->konsumen_no_wa_telepon = session('konsumen_no_wa_telepon', null);
                $baru->deskripsi = $this->f_deskripsi;
                $baru->sudah_nilai = 0;
                $baru->save();

                DB::commit();
                $this->redirectRoute('antrian-non-admin-lihat', navigate: true);
                $this->dispatch('notification', message: 'Informasi berhasil menyimpan antrian data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Informasi gagal menyimpan antrian data.');
            }

            return;
        }
        if($this->routeName == 'antrian-non-admin-item-edit')
        {
            DB::beginTransaction();
            try{
                $this->atrian_satker->tanggal = $this->f_tanggal;
                if($this->atrian_satker->periode !== $this->f_periode){
                    $this->atrian_satker->antrian = $this->f_periode.$antrian_baru;
                    $this->atrian_satker->antrian_internal = $antrian_internal_baru;
                }
                $this->atrian_satker->periode = $this->f_periode;
                $this->atrian_satker->deskripsi = $this->f_deskripsi;
                $this->atrian_satker->save();

                DB::commit();
                $this->redirectRoute('antrian-non-admin-lihat', navigate: true);
                $this->dispatch('notification', message: 'Informasi berhasil menyimpan antrian data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Informasi gagal menyimpan antrian data.');
            }

        }

    }

}
