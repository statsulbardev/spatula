@section('title', 'Kirim Pesan')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ url(env('APP_URL') . 'followup/complaint/lists') }}" style="color:#796AEE" class="h2 no-margin-bottom">Konfirmasi PJ Pengaduan / </a>
            <span class="h2 no-margin-bottom">Kirim Pesan</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Informasi Customer</h4>
                </div>
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Nama Konsumen</label>
                            <div class="col-sm-9">
                                {{ $customer->nama_konsumen }}
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Email</label>
                            <div class="col-sm-9">
                                {{ $customer->email_konsumen ?? '-' }}
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Nomor Whatsapp / Telepon</label>
                            <div class="col-sm-9">
                                {{ $customer->no_wa_telepon ?? '-' }}
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Saran/Pengaduan/Kritik/Apresiasi</label>
                            <div class="col-sm-9">
                                {{ $customer->saran_pengaduan ?? '-' }}
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kategori</label>
                            <div class="col-sm-9">
                                @if(!is_null($customer->kode_saran))
                                    @for($i = 0; $i < count($customer->kode_saran); $i++)
                                        <div class="mb-2">
                                            @include('components.badge.suggestion', [
                                                'suggest' => \App\Models\m_saran::where('kode_saran', collect($customer->kode_saran)->get($i))->pluck('id')[0]
                                            ])
                                        </div>
                                    @endfor
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Tindak Lanjut PJ Layanan</label>
                            <div class="col-sm-9">
                                <textarea wire:model="comment" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        @if(!is_null($customer->no_wa_telepon))
                            <button wire:click="switch('whatsapp')" class="btn btn-sm btn-success mr-2">
                                <i class="icon-paper-airplane"></i>
                                <span class="ml-2">Whatsapp</span>
                            </button>
                        @endif
                        @if(!is_null($customer->email_konsumen))
                            <button wire:click="switch('email')" class="btn btn-sm btn-primary">
                                <i class="icon-mail"></i>
                                <span class="ml-2">Email</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
