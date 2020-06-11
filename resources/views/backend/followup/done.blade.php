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
                    <h4>Daftar Customer</h4>
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
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ IDFormat::convertDateTime($item->created_at) }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->nama_konsumen }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->saran_pengaduan }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">
                                                    @if(!is_null($item->kode_saran))
                                                        @for($i = 0; $i < count($item->kode_saran); $i++)
                                                            {{ \App\Models\m_saran::where('id', collect($item->kode_saran)->get($i))->pluck('nama_saran')[0]  }},
                                                        @endfor
                                                    @else
                                                        -
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ IDFormat::convertDateTime($item->tanggal_selesai) }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Tidak ditemukan informasi tindak lanjut - selesai.</td>
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
