<?php

declare(strict_types=1);

namespace App\Livewire\Verification;

use App\Models\d_penilaian;
use App\Traits\HasModelProcess;
use App\Traits\HasInitialProperty;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceResponsibleList extends Component
{
    use HasModelProcess, HasInitialProperty, WithPagination;

    public d_penilaian $penilaian;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    /** @computed property : suggestions */
    public function getSuggestionsProperty(): array
    {
        return $this->initSuggestionsOption();
    }

    /** @computed property : colorSuggestions */
    public function getColorSuggestionsProperty(): array
    {
        return $this->initColorSuggestionsOption();
    }

    #[Title('PJ Layanan')]
    public function render(): View
    {
        return view('livewire.verification.service-responsible-list', [
            'services' => $this->retrieveData()
        ]);
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function finalizeServiceItem(d_penilaian $penilaian)
    {
        try {
            DB::beginTransaction();

            $penilaian->update([
                'selesai' => 1,
                'tanggal_selesai' => Carbon::now()
            ]);

            DB::commit();

            $result = "Verifikasi telah selesai, terima kasih.";
        } catch (Exception $error) {
            DB::rollBack();

            $result = "Verifikasi gagal diselesaikan.";
        }

        $this->dispatch('notification', message: $result);
    }

    public function deleteItem(d_penilaian $penilaian)
    {
        $this->penilaian = $penilaian;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->penilaian);

        $this->dispatch('notification', message: $result);
    }

    private function retrieveData(): Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return d_penilaian::search($this->searchKeyword)
            ->query(fn ($query) => $query->with(['petugas', 'layanan']))
            ->when(!$superadmin_role, function (Builder $query, $data) use ($user_unit_code) {
                $query->where('kode_satker_id', $user_unit_code);
            })
            ->where('selesai', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($this->numberOfPagination);
    }
}
