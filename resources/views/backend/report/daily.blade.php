@extends('home')

@section('title', 'Laporan Harian')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Laporan Harian</h2>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form class="d-inline-flex align-items-center" method="POST" action="{{ route('report.daily.show') }}">
                        @csrf
                        <label class="form-control-label mt-2 mr-2">Pilih Bulan dan Tahun : </label>
                        <div class="mr-2" style="width: 8rem !important">
                            <select name="bulan" class="form-control">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="mr-2">
                            -
                        </div>
                        <div class="mr-4" style="width: 8rem !important">
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Petugas</th>
                                    <th>Rating Petugas</th>
                                    <th>Jenis Layanan</th>
                                    <th>Rating Layanan</th>
                                    <th>Pengguna Layanan</th>
                                    <th>Saran dan Pengaduan</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count() > 0)
                                    @foreach($data as $index => $item)
                                        <tr>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ IDFormat::convertDateTime($item->created_at) }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $item->petugas->nama ?? '-' }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">
                                                    @if(!is_null($item->rating_petugas))
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($i < $item->rating_petugas)
                                                                @include('components.icon', ['name' => 'star', 'color' => '#796AEE'])
                                                            @else
                                                                @include('components.icon', ['name' => 'star'])
                                                            @endif
                                                        @endfor
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $item->layanan->nama_layanan }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">
                                                    <a class="text-dark">
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($i < $item->rating_layanan)
                                                                @include('components.icon', ['name' => 'star', 'color' => '#796AEE'])
                                                            @else
                                                                @include('components.icon', ['name' => 'star'])
                                                            @endif
                                                        @endfor
                                                    </a>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $item->nama_konsumen }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $item->saran_pengaduan }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">
                                                    @if(!is_null($item->kode_saran))
                                                        @for($i = 0; $i < count($item->kode_saran); $i++)
                                                            {{ \App\Models\m_saran::where('id', collect($item->kode_saran)->get($i))->pluck('nama_saran')[0]  }},
                                                        @endfor
                                                    @else
                                                        -
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                        <tr class="align-middle">
                                            <td colspan="8">Tidak ada informasi.</td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </section>
@endsection
