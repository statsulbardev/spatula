@extends('home')

@section('title', 'Konfirmasi PJ Layanan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Konfirmasi PJ Layanan</h2>
        </div>
    </header>
    <section>
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
                                    <th></th>
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
                                                <a href="{{ route() }}">{{ $item->nama_konsumen }}</a>
                                            </td>
                                            <td width="40%" class="align-middle">
                                                <p>{{ wordwrap($item->saran_pengaduan) ?? '-' }}</p>
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
                                                        Belum Dikategorisasi
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle justify-content-end d-flex">
                                                @if(!is_null($item->kode_saran))
                                                    <a class="text-white btn btn-sm btn-secondary" href="{{ route('followup.categorize.edit', $item->id) }}">Ubah Kategori</a>
                                                @else
                                                    <a class="text-white btn btn-sm btn-primary" href="{{ route('followup.categorize', $item->id) }}">Kategorisasi</a>
                                                @endif
                                                <a class="text-white btn btn-sm btn-info ml-4" href="{{ route('followup.sent', $item->id) }}">Kirim Pesan</a>
                                                @if(!is_null($item->kode_saran))
                                                    <form action="{{ route('followup.finish', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="text-white btn btn-sm btn-success ml-4" type="submit">Tandai Selesai</button>
                                                    </form>
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
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
