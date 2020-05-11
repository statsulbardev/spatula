@extends('home')

@section('title', 'Tindak Lanjut - Selesai')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Tindak Lanjut - Selesai</h2>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Tindak Lanjut Layanan - Selesai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pengguna Layanan</th>
                                    <th>Telepon/Whatsapp</th>
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
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->tanggal_notifikasi }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->nama_konsumen }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->no_wa_telepon }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->saran_pengaduan }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->saran->nama_saran }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('followup.detail.done', $item->id) }}">{{ $item->tanggal_selesai }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
