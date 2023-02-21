@section('title', 'Konfirmasi PJ Pengaduan')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Konfirmasi PJ Pengaduan</h2>
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
                                    <th>Pengguna Layanan</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Kategorisasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($complaints->count() > 0)
                                    @foreach ($complaints as $item)
                                        <tr>
                                            <td class="align-middle pr-4" width="60%">
                                                <small>
                                                    <i class="fa fa-calendar"></i> {{ DateFormat::convertDateTime($item->created_at) }}
                                                </small>
                                                <h4 class="mt-2 font-weight-bold text-primary">{{ $item->nama_konsumen }}</h4>
                                                <p>
                                                    <a tabindex="0" data-toggle="popover" title="Saran dan Pengaduan" data-trigger="hover" data-placement="bottom" data-content="{{ $item->saran_pengaduan }}">
                                                        {{ Str::limit($item->saran_pengaduan, 200, $end='...') }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                @if(!is_null($item->kode_saran))
                                                    @for($i = 0; $i < count($item->kode_saran); $i++)
                                                        <div class="mb-2">
                                                            @include('components.badge.suggestion', [
                                                                'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('id')[0]
                                                            ])
                                                        </div>
                                                    @endfor
                                                @else
                                                    Belum Dikategorisasi
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a>{{ $item->tanggal_kategorisasi ? DateFormat::convertDateTime($item->tanggal_kategorisasi) : '-'}}</a>
                                            </td>
                                            <td class="align-middle d-flex justify-content-between">
                                                <a
                                                    class="text-white btn btn-sm btn-warning"
                                                    href="{{ url(env('APP_URL') . 'followup/complaint/sent/' . $item->id) }}"
                                                    tabindex="0"
                                                    data-toggle="popover"
                                                    data-trigger="hover"
                                                    data-placement="bottom"
                                                    data-content="Kirim Pesan">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                                <a class="btn btn-sm btn-info text-white"
                                                    wire:click="finalConfirmation({{ $item->id }})"
                                                    tabindex="0"
                                                    data-toggle="popover"
                                                    data-trigger="hover"
                                                    data-placement="bottom"
                                                    data-content="Tandai Selesai">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </a>
                                                <a
                                                    class="btn btn-sm btn-primary"
                                                    href="{{ url(env('APP_URL') . 'followup/complaint/show/' . $item->id) }}"
                                                    tabindex="0"
                                                    data-toggle="popover"
                                                    data-trigger="hover"
                                                    data-placement="bottom"
                                                    data-content="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                {{-- <form action="{{ route('followup.finish', $item->id) }}" method="POST">
                                                    @method('PUT')
                                                    <button class="text-white btn btn-sm btn-success" type="submit">Tandai Selesai</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Tidak ditemukan informasi konfirmasi pj pengaduan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $complaints->links() }} --}}
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
