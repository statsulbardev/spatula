@switch($active)
    @case(1)
        <div class="badge badge-primary px-4 py-2">Aktif</div>
        @break
    @default
        <div class="badge badge-danger px-4 py-2">Tidak Aktif</div>
        @break
@endswitch
