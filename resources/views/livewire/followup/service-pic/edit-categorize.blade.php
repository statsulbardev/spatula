@section('title', 'Edit Kategorisasi')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ url(env('APP_URL') . '/followup/service/lists') }}" style="color:#796AEE" class="h2 no-margin-bottom">Konfirmasi PJ Layanan / </a>
            <span class="h2 no-margin-bottom">Kategorisasi Saran Pengaduan</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Informasi Customer</h4>
                </div>
                <form wire:submit.prevent="update">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-3 form-control-label">Nama Konsumen</label>
                            <div class="col-9">{{ $customer->nama_konsumen }}</div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-3 form-control-label">Email</label>
                            <div class="col-9">{{ $customer->email_konsumen ?? '-' }}</div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-3 form-control-label">Nomor Whatsapp / Telepon</label>
                            <div class="col-9">{{ $customer->no_wa_telepon ?? '-' }}</div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Saran/Pengaduan/Kritik/Apresiasi</label>
                            <div class="col-sm-9">
                                <p>{{ $customer->saran_pengaduan ?? '-' }}</p>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kategori Saran Pengaduan</label>
                            <div class="col-sm-9 d-flex justify-content-between">
                                <div class="item d-flex align-items-center">
                                    <input wire:model="suggest" type="checkbox" class="checkbox-template"
                                    @if(collect($customer->kode_saran)->contains(function($value, $key) { return $value === 1; }))
                                        checked
                                    @endif
                                    >
                                    <span class="ml-3 mt-1">Saran</span>
                                </div>
                                <div class="item d-flex align-items-center">
                                    <input wire:model="complaint" type="checkbox" class="checkbox-template"
                                    @if(collect($customer->kode_saran)->contains(function($value, $key) { return $value === 2; }))
                                        checked
                                    @endif
                                    >
                                    <span class="ml-3 mt-1">Pengaduan</span>
                                </div>
                                <div class="item d-flex align-items-center">
                                    <input wire:model="criticism" type="checkbox" class="checkbox-template"
                                    @if(collect($customer->kode_saran)->contains(function($value, $key) { return $value === 3; }))
                                        checked
                                    @endif
                                    >
                                    <span class="ml-3 mt-1">Kritik</span>
                                </div>
                                <div class="item d-flex align-items-center">
                                    <input wire:model="appreciation" type="checkbox" class="checkbox-template"
                                    @if(collect($customer->kode_saran)->contains(function($value, $key) { return $value === 4; }))
                                        checked
                                    @endif
                                    >
                                    <span class="ml-3 mt-1">Apresiasi</span>
                                </div>
                                <div class="item d-flex align-items-center">
                                    <input wire:model="other" type="checkbox" class="checkbox-template"
                                    @if(collect($customer->kode_saran)->contains(function($value, $key) { return $value === 9; }))
                                        checked
                                    @endif
                                    >
                                    <span class="ml-3 mt-1">Lainnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-save"></i>
                            <span class="ml-1">Perbaharui</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
