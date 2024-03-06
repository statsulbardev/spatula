<?php

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use App\Models\m_layanan;
use App\Models\m_pengguna;
use App\Repositories\VerificationRepository;
use App\Traits\HasRedirectUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class ServiceCategorization extends Component
{
    use HasRedirectUrl;

    public d_penilaian $pengguna_layanan;
    public string $route_name;

    /** @props */
    public $f_layanan;
    public $f_rating_layanan;
    public $f_petugas;
    public $f_rating_petugas;
    public $f_catatan;

    /** @props */
    public $cb_saran;
    public $cb_pengaduan;
    public $cb_kritik;
    public $cb_apresiasi;
    public $cb_lainnya;

    /** @computed Property : officers */
    public function getOfficersProperty()
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->kode_satker_id;

        return
            m_pengguna::query()
            ->when(!$superadmin_role, function (Builder $query, $data) use ($user_unit_code) {
                $query->where('kode_satker_id', $user_unit_code);
            })
            ->get(['id', 'nama'])
            ->toArray();
    }

    /** @computed Property : services */
    public function getServicesProperty()
    {
        return
            m_layanan::query()
            ->get(['kode_layanan', 'nama_layanan'])
            ->toArray();
    }

    /** @computed property : rootBreadcrumb */
    public function getRootBreadcrumbProperty(): array
    {
        return [
            'route'  => route('daftar-pj-layanan'),
            'label'  => 'Daftar Verifikasi',
        ];
    }

    /** @computed property : firstBreadcrumb */
    public function getFirstBreadcrumbProperty(): array
    {
        return [
            'route' => route('tambah-kategorisasi-layanan', request()->route()->originalParameters()),
            'label' => 'Kategorisasi Layanan',
        ];
    }

    /** @computed property : secondBreadcrumb */
    public function getSecondBreadcrumbProperty(): string
    {
        return request()->route()->parameters()['pengguna_layanan']['nama_konsumen'];
    }

    public function render(): View
    {
        return view('livewire.verification.service-categorization')
            ->layout('layouts.app');
    }

    public function mount(d_penilaian $pengguna_layanan)
    {
        $this->route_name       = Route::currentRouteName();
        $this->pengguna_layanan = $pengguna_layanan;
        $this->f_layanan        = $pengguna_layanan->kode_layanan;
        $this->f_rating_layanan = $pengguna_layanan->rating_layanan;
        $this->f_petugas        = $pengguna_layanan->kode_petugas;
        $this->f_rating_petugas = $pengguna_layanan->rating_petugas;

        if ($this->route_name === "edit-kategorisasi-layanan") {
            $this->cb_saran     = in_array(1, $this->pengguna_layanan->kode_saran) ?? false;
            $this->cb_pengaduan = in_array(2, $this->pengguna_layanan->kode_saran) ?? false;
            $this->cb_kritik    = in_array(3, $this->pengguna_layanan->kode_saran) ?? false;
            $this->cb_apresiasi = in_array(4, $this->pengguna_layanan->kode_saran) ?? false;
            $this->cb_lainnya   = in_array(9, $this->pengguna_layanan->kode_saran) ?? false;
            $this->f_catatan    = $pengguna_layanan->catatan;
        }
    }

    public function submitData(VerificationRepository $verificationRepository)
    {
        $data = [
            $this->cb_saran ? 1 : null,
            $this->cb_pengaduan ? 2 : null,
            $this->cb_kritik ? 3 : null,
            $this->cb_apresiasi ? 4 : null,
            $this->cb_lainnya ? 9 : null,
        ];

        if (count(array_filter($data)) === 0) return redirect()->back();

        $result = $verificationRepository->verifyByServiceOfficer($this, $data);

        session()->flash('messages', $result);

        $this->callbackUrl('/verifikasi/pj-layanan');
    }
}
