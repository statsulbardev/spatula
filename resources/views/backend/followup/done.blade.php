@extends('home')

@section('title', 'Selesai Tindak Lanjut')

@section('inner-content')
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
                                                <a style="color:#666666" class="text-decoration-none" href="{{ route('followup.detail.done', $item->id) }}">
                                                    <i class="icon-user"></i>
                                                    <span class="ml-1">{{ $item->nama_konsumen }}</span>
                                                </a>
                                            </td>
                                            <td width="40%" class="align-middle">
                                                <p>{{ wordwrap($item->saran_pengaduan) }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <span>
                                                    @if(!is_null($item->kode_saran))
                                                        <ul class="ml-n4">
                                                        @for($i = 0; $i < count($item->kode_saran); $i++)
                                                            <li>{{ \App\Models\m_saran::where('kode_saran', collect($item->kode_saran)->get($i))->pluck('nama_saran')[0] }}</li>
                                                        @endfor
                                                        </ul>
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span>{{ DateFormat::convertDateTime($item->tanggal_selesai) }}</span>
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
                    {{ $dones->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
