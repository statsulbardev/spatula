@extends('layouts.app')

@section('title', 'Penilaian Petugas')

@section('styles')
<link href="{{ asset('vendor/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="page">
    <div class="page-content d-flex align-items-stretch">
        <div class="content-inner mx-auto">
            <section class="forms">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Mohon isi data diri Anda:</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('penilaian.petugas.store', ['satker' => $kantor->kode_satker]) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Nama Lengkap <sup class="border border-danger rounded p-1 text-danger">Wajib</sup></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_konsumen" class="form-control">
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email_konsumen" class="form-control" placeholder="contoh: john.doe@gmail.com">
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Nomor Telepon / Whatsapp <sup class="border border-danger rounded p-1 text-danger">Wajib</sup></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="no_wa_telepon" class="form-control">
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row text-center mb-4">
                                    <h1 class="col-lg-12 form-control-label">
                                        Bagaimana penilaian Anda terhadap petugas layanan di Pelayanan Statistik Terpadu BPS {{ $kantor->nama }}:
                                    </h1>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Nama Petugas</label>
                                    <div class="col-sm-9">
                                        <select name="kode_petugas" class="form-control mb-3">
                                            @foreach($petugas as $pelayan)
                                                <option value="{{ $pelayan->id }}">{{ $pelayan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Rating Petugas</label>
                                    <div class="col-sm-9">
                                        <select class="star-rating" name="rating_petugas" class="form-control mb-3">
                                            <option value="1">Sangat Tidak Puas</option>
                                            <option value="2">Tidak Puas</option>
                                            <option value="3">Cukup Puas</option>
                                            <option value="4">Puas</option>
                                            <option value="5">Sangat Puas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row text-center mb-4">
                                    <h1 class="col-lg-12 form-control-label">
                                        Bagaimana penilaian Anda terhadap layanan di BPS {{ $kantor->nama }}:
                                    </h1>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Jenis Layanan</label>
                                    <div class="col-sm-9">
                                        <select name="kode_layanan" class="form-control mb-3">
                                            @foreach($j_layanan as $service)
                                                <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Rating Layanan</label>
                                    <div class="col-sm-9">
                                        <select class="star-rating" name="rating_layanan" class="form-control mb-3">
                                            <option value="1">Sangat Tidak Puas</option>
                                            <option value="2">Tidak Puas</option>
                                            <option value="3">Cukup Puas</option>
                                            <option value="4">Puas</option>
                                            <option value="5">Sangat Puas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row text-center mb-4">
                                    <h1 class="col-lg-12 form-control-label">
                                        Berikan saran/pengaduan/kritik/apresiasi untuk layanan di BPS {{ $kantor->nama }}:
                                    </h1>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Kritik dan Saran <sup class="border border-danger rounded p-1 text-danger">Wajib</sup></label>
                                    <div class="col-sm-9">
                                        <textarea name="saran_pengaduan" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-block btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/star-rating/star-rating.min.js') }}"></script>
<script>
    var starRatingControl = new StarRating('.star-rating', {
        maxStars: 5,
        showText: true,
    });
</script>
@endpush
