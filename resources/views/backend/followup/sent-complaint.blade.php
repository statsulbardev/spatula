@extends('home')

@section('title', 'Kirim WA/Email')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ route('followup.complaint') }}" style="color:#796AEE" class="h2 no-margin-bottom">Konfirmasi PJ Pengaduan / </a>
            <span class="h2 no-margin-bottom">Kirim Whatsapp atau Email</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Informasi Customer</h4>
                </div>
                <form method="POST" action="{{ route('followup.sent.complaint.store', $customer->id) }}">
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
                                {{ $customer->email_konsumen ?? '-' }}
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
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kategori</label>
                            <div class="col-sm-9">
                                @if(!is_null($customer->kode_saran))
                                    @for($i = 0; $i < count($customer->kode_saran); $i++)
                                        {{ \App\Models\m_saran::where('id', collect($customer->kode_saran)->get($i))->pluck('nama_saran')[0]  }},
                                    @endfor
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Tindak Lanjut PJ Pengaduan</label>
                            <div class="col-sm-9">
                                <textarea name="text_pj_pengaduan" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success mr-4" name="button" value="whatsapp">
                            <i class="icon-paper-airplane"></i> Whatsapp
                        </button>
                        <button type="submit" class="btn btn-sm btn-warning" name="button" value="email">
                            <i class="icon-mail"></i> Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
