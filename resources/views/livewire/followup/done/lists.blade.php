@section('title', 'Selesai Tindak Lanjut')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Selesai Tindak Lanjut</h2>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Daftar Pengguna Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Pengguna Layanan</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Selesai</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dones->count() > 0)
                                    @foreach ($dones as $item)
                                        <tr>
                                            <td class="align-middle pr-4" width="70%">
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
                                                <span>
                                                    @if(!is_null($item->kode_saran))
                                                        @if (count($item->kode_saran) > 1)
                                                            @for($i = 0; $i < count($item->kode_saran); $i++)
                                                                <div class="mb-2">
                                                                    @include('components.badge.suggestion', [
                                                                        'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('id')[0]
                                                                    ])
                                                                </div>
                                                            @endfor
                                                        @else
                                                            @include('components.badge.suggestion', [
                                                                'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get(0))->pluck('id')[0]
                                                            ])
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span>{{ DateFormat::convertDateTime($item->tanggal_selesai) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a
                                                    class="btn btn-primary"
                                                    href="{{ url(env('APP_URL') . 'followup/done/show/' . $item->id) }}"
                                                    tabindex="0"
                                                    data-toggle="popover"
                                                    data-trigger="hover"
                                                    data-placement="bottom"
                                                    data-content="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Tidak ditemukan informasi tindak lanjut dengan status selesai.</td>
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
