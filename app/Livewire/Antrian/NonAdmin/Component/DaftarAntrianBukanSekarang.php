<?php

namespace App\Livewire\Antrian\NonAdmin\Component;

use App\Models\d_antrian_satker;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Exception;

class DaftarAntrianBukanSekarang extends Component
{

    use WithPagination;
    public int $numberOfPagination = 20;
    public ?string $searchKeyword = null;
    
    public function render() : View
    {
       
        return view('livewire.antrian.non-admin.component.daftar_antrian_bukan_sekarang', ['data' => $data]);
    }

    private function retrieveData() : Paginator
    {
        $superadmin_role = auth()->user()->hasRole('superadmin');

        $user_unit_code  = auth()->user()->satker->kode_satker;


        $data = d_antrian_satker::with(['satker', 'layanan'])
        ->where('konsumen_email', session('konsumen_email'))
        ->where('konsumen_no_wa_telepon', session('konsumen_no_wa_telepon'))
        ->where('konsumen_tahun_lahir', session('konsumen_tahun_lahir'))
        ->get();
        

        return m_pengguna::search($this->searchKeyword)
                -> query(fn ($query) => $query->with(['satker', 'roles']))
                -> when(! $superadmin_role, function(Builder $query, $data) use ($user_unit_code) {
                    $query->where('kode_satker_id', $user_unit_code);
                })
                -> orderBy('kode_satker_id', 'asc')
                -> paginate($this->numberOfPagination);
    }

}
