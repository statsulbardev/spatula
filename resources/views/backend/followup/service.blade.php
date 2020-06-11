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
                                                <a>{{ IDFormat::convertDateTime($item->created_at) }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a>{{ $item->nama_konsumen }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a>{{ $item->saran_pengaduan ?? '-' }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a>
                                                    @if(!is_null($item->kode_saran))
                                                        @for($i = 0; $i < count($item->kode_saran); $i++)
                                                            {{ \App\Models\m_saran::where('id', collect($item->kode_saran)->get($i))->pluck('nama_saran')[0]  }},
                                                        @endfor
                                                    @else
                                                        -
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="align-middle d-flex justify-content-around">
                                                <a class="text-white btn btn-sm btn-primary" href="{{ route('followup.categorize', $item->id) }}">Kategorisasi</a>
                                                <a class="text-white btn btn-sm btn-info" href="{{ route('followup.sent', $item->id) }}">Kirim</a>
                                                <form action="{{ route('followup.finish', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="text-white btn btn-sm btn-success" type="submit">Selesai</button>
                                                </form>
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
