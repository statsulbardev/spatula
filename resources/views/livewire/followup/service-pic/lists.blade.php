@section('title', 'Konfirmasi PJ Layanan')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Konfirmasi PJ Layanan</h2>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            @include('components.notification.flash')
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Daftar Konfirmasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pengguna Layanan</th>
                                    <th>Saran dan Pengaduan</th>
                                    <th>Kategori Saran Pengaduan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($services->count() > 0)
                                    @foreach ($services as $item)
                                        @if($item->kode_saran === [2])
                                            @continue
                                        @endif
                                        <tr>
                                            <td class="align-middle">
                                                <span>{{ DateFormat::convertDateTime($item->created_at) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="ml-1">{{ $item->nama_konsumen }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <p>
                                                    <a tabindex="0" data-toggle="popover" title="Saran dan Pengaduan" data-trigger="hover" data-placement="bottom" data-content="{{ $item->saran_pengaduan }}">
                                                        {{ Str::limit($item->saran_pengaduan, 50, $end='...') }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="align-middle" width="20%">
                                                @if(!is_null($item->kode_saran))
                                                    <div class="d-flex flex-wrap justify-content-between">
                                                        @for($i = 0; $i < count($item->kode_saran); $i++)
                                                            @if ($i === 0)
                                                                <span class="mt-2">
                                                                    @include('components.badge.suggestion', [
                                                                        'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('id')[0]
                                                                    ])
                                                                </span>
                                                            @else
                                                                <span class="mt-2">
                                                                    @include('components.badge.suggestion', [
                                                                        'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('id')[0]
                                                                    ])
                                                                </span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                @else
                                                    Belum Dikategorisasi
                                                @endif
                                            </td>
                                            <td class="align-middle d-flex justify-content-between">
                                                @if(!is_null($item->kode_saran))
                                                    {{-- <a class="text-white btn btn-sm btn-secondary" href="{{ route('followup.categorize.edit', $item->id) }}">Ubah Kategori</a> --}}
                                                    <a class="btn btn-sm btn-secondary" href="" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Ubah Kategori">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                @else
                                                    {{-- <a class="text-white btn btn-sm btn-primary" href="{{ route('followup.categorize', $item->id) }}">Kategorisasi</a> --}}
                                                    <a class="btn btn-sm btn-info" href="{{ url(env('APP_URL') . '/followup/service/categorize/' . $item->id) }}" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Kategorisasi">
                                                        <i class="fa fa-list"></i>
                                                    </a>
                                                @endif
                                                {{-- <a class="text-white btn btn-sm btn-info ml-4" href="{{ route('followup.sent', $item->id) }}">Kirim Pesan</a> --}}
                                                <a class="btn btn-sm btn-warning" href="" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Kirim Pesan">
                                                    <i class="fa fa-mail-forward"></i>
                                                </a>
                                                <a class="btn btn-sm btn-primary" href="{{ url(env('APP_URL') . '/followup/service/show/' . $item->id) }}" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if(!is_null($item->kode_saran))
                                                    {{-- <form action="{{ route('followup.finish', $item->id) }}" method="POST"> --}}
                                                        <a class="text-white btn btn-sm btn-success" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Tandakan Selesai">
                                                            <i class="fa fa-check-circle"></i>
                                                        </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Tidak ditemukan informasi tindak lanjut - konfirmasi pj layanan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@endpush
