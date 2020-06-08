@extends('layouts.app')

@section('title', 'Penilaian Petugas')

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
                            <form class="form-horizontal" action="{{ route('form.first.store') }}" method="POST">
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
                                        Bagaimana penilaian Anda terhadap petugas layanan di Pelayanan Statistik Terpadu BPS Provinsi Sulawesi Barat:
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
                                        <select name="rating_petugas" class="form-control mb-3">
                                            <option value="1">Rating 1</option>
                                            <option value="2">Rating 2</option>
                                            <option value="3">Rating 3</option>
                                            <option value="4">Rating 4</option>
                                            <option value="5">Rating 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row text-center mb-4">
                                    <h1 class="col-lg-12 form-control-label">
                                        Berikan saran/pengaduan/kritik/apresiasi untuk layanan di BPS Provinsi Sulawesi Barat:
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
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
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
