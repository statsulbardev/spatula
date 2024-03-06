<?php

namespace App\Livewire\Dashboard;

use App\Models\d_penilaian;
use App\Traits\HasInitialProperty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    use HasInitialProperty;

    // Informasi Verifikasi Layanan
    public int $completes;
    public int $notCompletes;
    public int $serviceResponsible;
    public int $complaintResponsible;

    // Informasi Petugas Layanan
    public Collection $officers;

    // Informasi Kategorisasi Saran Pengaduan
    public array $categorize;
    public int $notCategorize;

    // Informasi Rating Layanan
    public Collection $popularService;
    public Collection $ratingService;

    /** @computed property : listOfficers */
    public function getListOfficersProperty(): array
    {
        return $this->initOfficersOption();
    }

    /** @computed propert : services */
    public function getServicesProperty(): array
    {
        return $this->initServicesOption();
    }

    public function mount(): void
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $result = d_penilaian::with(['petugas', 'layanan'])
            ->when(!$superadmin_role, function (Builder $query) use ($user_unit_code) {
                $query->where('kode_satker_id', $user_unit_code);
            })
            ->get();

        $this->completes            = $result->where('selesai', 1)->count();
        $this->notCompletes         = $result->where('selesai', 0)->count();
        $this->serviceResponsible   = $result->where('selesai', 0)->where('is_pengaduan', '!=', 1)->count();
        $this->complaintResponsible = $result->where('selesai', 0)->where('is_pengaduan', true)->count();

        $this->officers             = $result->groupBy('kode_petugas')->map->count();

        $values                     = $result->pluck('kode_saran')->flatten()->all();
        $this->categorize           = array_count_values(array_filter($values));
        $this->notCategorize        = count($values) - count(array_filter($values));

        $this->ratingService        = $result->groupBy('kode_layanan')->map->avg('rating_layanan')->sortDesc()->take(3);
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard')->layout('layouts.app');
    }
}
