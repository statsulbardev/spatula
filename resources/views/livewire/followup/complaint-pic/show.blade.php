@section('title', $complaintDetail->nama_konsumen)

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ url(env('APP_URL') . 'followup/complaint/lists') }}" style="color:#796AEE" class="h2 no-margin-bottom">Konfirmasi PJ Pengaduan / </a>
            <span class="h2 no-margin-bottom">{{ $complaintDetail->nama_konsumen }}</span>
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
                            {{ DateFormat::convertDateTime($complaintDetail->created_at) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nama</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->nama_konsumen }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Email</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->email_konsumen ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nomor Whatsapp / Telepon</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->no_wa_telepon ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nama Petugas</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->petugas->nama ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Rating Petugas</label>
                        <div class="col-sm-9">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $complaintDetail->rating_petugas)
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
                            {{ $complaintDetail->layanan->nama_layanan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Rating Layanan</label>
                        <div class="col-sm-9">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $complaintDetail->rating_layanan)
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
                            @if(!is_null($complaintDetail->kode_saran))
                                @for($i = 0; $i < count($complaintDetail->kode_saran); $i++)
                                    <div class="mb-2">
                                        @include('components.badge.suggestion', [
                                            'suggest' => \App\Models\m_saran::where('kode_saran', collect($complaintDetail->kode_saran)->get($i))->pluck('id')[0]
                                        ])
                                    </div>
                                @endfor
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Saran Pengaduan</label>
                        <div class="col-sm-9">
                            <p>{{ $complaintDetail->saran_pengaduan ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Notifikasi</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->tanggal_notifikasi ? DateFormat::convertDateTime($complaintDetail->tanggal_notifikasi) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Kategorisasi</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->tanggal_kategorisasi ? DateFormat::convertDateTime($complaintDetail->tanggal_kategorisasi) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Tindak Lanjut PJ Pelayanan</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->tanggal_tl_pj_layanan ? DateFormat::convertDateTime($complaintDetail->tanggal_tl_pj_layanan) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Komentar PJ Pelayanan</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->text_pj_layanan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Tindak Lanjut PJ Pengaduan</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->tanggal_tl_pj_pengaduan ? DateFormat::convertDateTime($complaintDetail->tanggal_tl_pj_pengaduan) : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Komentar PJ Pengaduan</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->text_pj_pengaduan ?? '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tanggal Selesai Tindak Lanjut</label>
                        <div class="col-sm-9">
                            {{ $complaintDetail->tanggal_selesai ? DateFormat::convertDateTime($complaintDetail->tanggal_selesai) : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
