@switch($suggest)
    @case(1)
        <div class="badge badge-primary px-4 py-2">Saran</div>
        @break
    @case(2)
        <div class="badge badge-warning px-4 py-2">Pengaduan</div>
        @break
    @case(3)
        <div class="badge badge-danger px-4 py-2">Kritik</div>
        @break
    @case(4)
        <div class="badge badge-success px-4 py-2">Apresiasi</div>
        @break
    @case(5)
        <div class="badge badge-secondary px-4 py-2">Lainnya</div>
        @break
@endswitch
