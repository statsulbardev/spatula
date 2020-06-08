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
                    <label class="form-control-label mt-2 mr-2">Pilih Tahun : </label>
                    <div class="mr-4" style="width: 10% !important">
                        <select name="tahun" class="form-control">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Rating Rata-Rata</th>
                                                    <th>Jumlah Terlayani</th>
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
                                                            <td colspan="3">Tidak ada informasi.</td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- {{ $users->links() }} --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Jenis Layanan</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($query_2_3)
                                                    @foreach($query_2_3 as $index => $data)
                                                        <tr>
                                                            <td class="align-middle">
                                                                <a class="text-dark">@include('components.month', ['month' => $data->bulan])</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->nama_layanan }}</a>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a class="text-dark">{{ $data->jumlah_terlayani }}</a>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Jenis Layanan</th>
                                                    <th>Rating Rata-Rata</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($query_2_3)
                                                    @foreach($query_2_3 as $index => $data)
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
