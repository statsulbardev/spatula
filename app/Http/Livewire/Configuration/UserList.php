<?php

namespace App\Http\Livewire\Configuration;

use App\Models\m_pengguna;
use App\Traits\HasModelProcess;
use App\Traits\UnitCode;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use HasModelProcess, UnitCode, WithPagination;

    public m_pengguna $pengguna;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;

    public function render() : View
    {
        return view('livewire.configuration.user-list', [
            'users' => $this->retrieveData()
        ])->layout('layouts.app');
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

        $this->dispatchBrowserEvent('notification', ['message' => $result]);
    }

    private function retrieveData() : Paginator
    {
        $authUser = auth()->user();

        if ($authUser->hasRole('superadmin')) {
            $result = m_pengguna::search($this->searchKeyword)
                        -> query(fn ($query) => $query->with(['satker', 'roles']))
                        -> orderBy('kode_satker_id', 'asc');
        } elseif ($authUser->hasRole('admin') || $authUser->hasRole('pimpinan')) {
            $result = m_pengguna::search($this->searchKeyword)
                        -> where('kode_satker_id', $this->getUnitCode()->kode_satker)
                        -> where('role_id', '>', 1);
        } else {
            $result = m_pengguna::search($this->searchKeyword)->where('id', auth()->id());
        }

        return $result->paginate($this->numberOfPagination);
    }
}
