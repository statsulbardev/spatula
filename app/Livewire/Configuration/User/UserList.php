<?php

declare(strict_types=1);

namespace App\Livewire\Configuration\User;

use App\Models\m_pengguna;
use App\Traits\HasModelProcess;
use Laravel\Scout\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use HasModelProcess, WithPagination;

    /** @props */
    public m_pengguna $pengguna;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    #[Title('Pengaturan Pengguna')]
    public function render() : View
    {
        return view('livewire.configuration.user.user-list', ['users' => $this->retrieveData()]);
    }

    public function updatedNumberOfPagination()
    {
        $this->resetPage();
    }

    public function deleteItem(m_pengguna $pengguna)
    {
        $this->pengguna = $pengguna;
    }

    public function confirmDeleteItem()
    {
        $result = $this->delete($this->pengguna);

        $this->dispatch('notification', message: $result);
    }

    private function retrieveData() : Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;

        return m_pengguna::search($this->searchKeyword)
                -> query(fn ($query) => $query->with(['satker', 'roles']))
                -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                    $query->where('kode_satker_id', $user_unit_code);
                })
                -> orderBy('kode_satker_id', 'asc')
                -> paginate($this->numberOfPagination);
    }
}
