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
                                    <th>Tanggal</th>
                                    <th>Pengguna Layanan</th>
                                    <th>Saran dan Pengaduan</th>
                                    <th>Kategori</th>
                                    <th>Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dones->count() > 0)
                                    @foreach ($dones as $item)
                                        <tr>
                                            <td class="align-middle">
                                                <span>{{ DateFormat::convertDateTime($item->created_at) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="ml-1">{{ $item->nama_konsumen }}</span>
                                            </td>
                                            <td width="40%" class="align-middle">
                                                <p>
                                                    <a tabindex="0" data-toggle="popover" title="Saran dan Pengaduan" data-trigger="focus" data-content="{{ $item->saran_pengaduan }}">
                                                        {{ Str::limit($item->saran_pengaduan, 70, $end='...') }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                <span>
                                                    @if(!is_null($item->kode_saran))
                                                        @if (count($item->kode_saran) > 1)
                                                            <ul class="ml-n4">
                                                                @for($i = 0; $i < count($item->kode_saran); $i++)
                                                                    <li class="my-2">
                                                                        @include('components.badge.suggestion', [
                                                                            'suggest' => \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('id')[0]
                                                                        ])
                                                                    </li>
                                                                @endfor
                                                            </ul>
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
                                            <td>
                                                <a href="{{ url(env('APP_URL') . '/followup/done/show/' . $item->id) }}" class="btn btn-primary">
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
