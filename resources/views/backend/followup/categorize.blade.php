@extends('home')

@section('title', 'Tindak Lanjut - Kategorisasi')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ route('followup.service') }}" style="color:#796AEE" class="h2 no-margin-bottom">Konfirmasi PJ Layanan / </a>
            <span class="h2 no-margin-bottom">Kategorisasi Saran Pengaduan</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Kategorisasi Saran Pengaduan</h4>
                </div>
                <form method="POST" action="{{ route('followup.categorize.store', $customer->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Nama Konsumen</label>
                            <div class="col-sm-9">
                                {{ $customer->nama_konsumen }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Email</label>
                            <div class="col-sm-9">
                                {{ $customer->email ?? '-' }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Nomor Whatsapp / Telepon</label>
                            <div class="col-sm-9">
                                {{ $customer->no_wa_telepon ?? '-' }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Saran/Pengaduan/Kritik/Apresiasi</label>
                            <div class="col-sm-9">
                                {{ $customer->saran_pengaduan ?? '-' }}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 form-control-label">Kategori Saran Pengaduan</label>
                            <div class="col-sm-9 d-flex justify-content-between">
                                <div class="item d-flex">
                                    <input type="checkbox" id="input-1" name="saran" class="checkbox-template">
                                    <label for="input-1">Saran</label>
                                </div>
                                <div class="item d-flex">
                                    <input type="checkbox" id="input-2" name="pengaduan" class="checkbox-template">
                                    <label for="input-2">Pengaduan</label>
                                </div>
                                <div class="item d-flex">
                                    <input type="checkbox" id="input-3" name="kritik" class="checkbox-template">
                                    <label for="input-3">Kritik</label>
                                </div>
                                <div class="item d-flex">
                                    <input type="checkbox" id="input-4" name="apresiasi" class="checkbox-template">
                                    <label for="input-4">Apresiasi</label>
                                </div>
                                <div class="item d-flex">
                                    <input type="checkbox" id="input-5" name="lainnya" class="checkbox-template">
                                    <label for="input-5">Lainnya</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
