@extends('home')

@section('title', 'Laporan Bulanan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Laporan Bulanan</h2>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-inline-flex align-items-center">
                    <form class="d-inline-flex align-items-center" action="{{ route('report.monthly.show') }}" method="POST">
                        @csrf
                        <label class="form-control-label mt-2 mr-2" style="width: 40% !important">Pilih Tahun : </label>
                        <div class="mr-4" style="width: 40% !important">
                            <select name="tahun" class="form-control">
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Laporan Bulanan Rating Petugas Layanan Tahun {{ $year }}</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Rating Rata-Rata</th>
                                                    <th>Jumlah Penilaian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($query_1)
                                                    @foreach($query_1 as $index => $data)
                                                        <tr>
                                                            <td class="align-middle">
                                                                <a class="text-dark">@include('components.month', ['month' => $data->bulan])</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->nama }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ number_format($data->rerata, 2) }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->jumlah_terlayani }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr class="align-middle">
                                                            <td colspan="4">Tidak ada informasi.</td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- {{ $users->links() }} --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">Laporan Bulanan Saran Pengaduan Tahun {{ $year }}</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Nama Saran</th>
                                                    <th>Jumlah Saran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($query_2)
                                                    @foreach($query_2 as $index => $data)
                                                        <tr>
                                                            <td class="align-middle">
                                                                <a class="text-dark">@include('components.month', ['month' => $data->bulan])</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->nama_saran }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->jumlah_saran }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr class="align-middle">
                                                            <td colspan="3">Tidak ada informasi.</td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- {{ $users->links() }} --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Laporan Bulanan Rating Layanan Tahun {{ $year }}</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Jenis Layanan</th>
                                                    <th>Rating Rata-Rata</th>
                                                    <th>Jumlah Penilaian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($query_3)
                                                    @foreach($query_3 as $index => $data)
                                                        <tr>
                                                            <td class="align-middle">
                                                                <a class="text-dark">@include('components.month', ['month' => $data->bulan])</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->nama_layanan }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ number_format($data->rerata, 2) }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a href="text-dark">{{ $data->jumlah_terlayani }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr class="align-middle">
                                                            <td colspan="3">Tidak ada informasi.</td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- {{ $users->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
