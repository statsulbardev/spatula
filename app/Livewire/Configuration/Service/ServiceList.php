<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\Service;

use App\Models\m_layanan;
use App\Traits\HasModelProcess;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceList extends Component
{
    use HasModelProcess, WithPagination;

    public m_layanan $layanan;

    public int $numberOfPagination = 20;

    public ?string $searchKeyword = null;

    #[Title('Pengaturan Layanan')]
    public function render(): View
    {
        $masterLayanan = m_layanan::search($this->searchKeyword)->orderBy('id', 'asc')->paginate($this->numberOfPagination);

        $layananSatker = auth()->user()->satker->layanan;

        return view('livewire.configuration.service.service-list', [
            'services'    => $masterLayanan,
            'unitService' => $layananSatker
        ])
        ->layout('components.layouts.app');
    }

    // reset pagination
    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_layanan $layanan)
    {
        $this->layanan = $layanan;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->layanan);

        $this->dispatch('notification', message: $result);
    }

    public function setUnitService($id)
    {
        try {
            DB::beginTransaction();

            DB::table('m_satker_layanan')->insert([
                'm_satker_id'  => auth()->user()->satker->id,
                'm_layanan_id' => $id
            ]);

            DB::commit();

            $this->dispatch('notification', message:'Telah ditambahkan ke layanan satker');
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());

            $this->dispatch('notification', message:'Tidak dapat ditambahkan ke layanan satker');
        }
    }

    public function removeUnitService($unitId, $serviceId)
    {
        try {
            DB::beginTransaction();

            DB::table('m_satker_layanan')->where('m_satker_id', $unitId)->where('m_layanan_id', $serviceId)->delete();

            DB::commit();

            $this->dispatch('notification', message:'Layanan satker telah dihapus');
        } catch(Exception $error) {
            DB::rollBack();

            Log::error($error->getMessage());
        }
    }
}
