@extends('home')

@section('title', 'Detail Pengguna Layanan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ route('followup.done') }}" style="color:#796AEE" class="h2 no-margin-bottom">Selesai Tindak Lanjut / </a>
            <span class="h2 no-margin-bottom">{{ $done[0]->nama_konsumen }} - {{ $done[0]->layanan->nama_layanan }}</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Informasi Pengguna Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Layanan</label>
                        <div class="col-sm-9">
                            {{ DateFormat::convertDateTime($done[0]->created_at) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nama</label>
                        <div class="col-sm-9">
                            {{ $done[0]->nama_konsumen }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Email</label>
                        <div class="col-sm-9">
                            {{ $done[0]->email_konsumen ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nomor Whatsapp / Telepon</label>
                        <div class="col-sm-9">
                            {{ $done[0]->no_wa_telepon ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nama Petugas</label>
                        <div class="col-sm-9">
                            {{ $done[0]->petugas->nama ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Rating Petugas</label>
                        <div class="col-sm-9">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $done[0]->rating_petugas)
                                    @include('components.icon', ['name' => 'star', 'color' => '#796AEE'])
                                @else
                                    @include('components.icon', ['name' => 'star'])
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Jenis Layanan</label>
                        <div class="col-sm-9">
                            {{ $done[0]->layanan->nama_layanan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Rating Layanan</label>
                        <div class="col-sm-9">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $done[0]->rating_layanan)
                                    @include('components.icon', ['name' => 'star', 'color' => '#796AEE'])
                                @else
                                    @include('components.icon', ['name' => 'star'])
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Kategori Saran Pengaduan</label>
                        <div class="col-sm-9">
                            @if(!is_null($done[0]->kode_saran))
                                <ul class="ml-n4">
                                @for($i = 0; $i < count($done[0]->kode_saran); $i++)
                                    <li>{{ \App\Models\m_saran::where('kode_saran', collect($done[0]->kode_saran)->get($i))->pluck('nama_saran')[0] }}</li>
                                @endfor
                                </ul>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Saran Pengaduan</label>
                        <div class="col-sm-9">
                            <p>{{ $done[0]->saran_pengaduan ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Notifikasi</label>
                        <div class="col-sm-9">
                            {{ $done[0]->tanggal_notifikasi ? DateFormat::convertDateTime($done[0]->tanggal_notifikasi) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Kategorisasi</label>
                        <div class="col-sm-9">
                            {{ $done[0]->tanggal_kategorisasi ? DateFormat::convertDateTime($done[0]->tanggal_kategorisasi) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Tindak Lanjut PJ Pelayanan</label>
                        <div class="col-sm-9">
                            {{ $done[0]->tanggal_tl_pj_layanan ? DateFormat::convertDateTime($done[0]->tanggal_tl_pj_layanan) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Komentar PJ Pelayanan</label>
                        <div class="col-sm-9">
                            {{ $done[0]->text_pj_layanan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Tindak Lanjut PJ Pengaduan</label>
                        <div class="col-sm-9">
                            {{ $done[0]->tanggal_tl_pj_pengaduan ? DateFormat::convertDateTime($done[0]->tanggal_tl_pj_pengaduan) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Komentar PJ Pengaduan</label>
                        <div class="col-sm-9">
                            {{ $done[0]->text_pj_pengaduan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Selesai Tindak Lanjut</label>
                        <div class="col-sm-9">
                            {{ DateFormat::convertDateTime($done[0]->tanggal_selesai) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
