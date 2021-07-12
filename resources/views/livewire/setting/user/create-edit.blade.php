@section('title', !is_null($user) ? 'Edit ' . $user->nama : 'Tambah User Baru')

<div>
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ url(env('APP_URL') . '/setting/user/lists') }}" style="color:#796AEE" class="h2 no-margin-bottom">
                Pengguna Aplikasi /
            </a>
            <span class="h2 no-margin-bottom">{{ !is_null($user) ? $user->nama : 'Tambah' }}</span>
        </div>
    </header>

    <section>
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Isikan Informasi Pengguna Aplikasi</h3>
                    </div>
                    <form wire:submit.prevent="save">
                        @csrf

                        <div class="card-body">
                            {{-- Nama Lengkap --}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-md-3 form-control-label">Nama Lengkap</label>
                                <div class="col-lg-9 col-md-9">
                                    <input wire:model.defer="fullname" type="text" class="form-control">
                                    @error('fullname')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Email --}}
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Email</label>
                                <div class="col-sm-9">
                                    <input wire:model.defer="email" type="email" class="form-control">
                                    @error('email')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Password --}}
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Password</label>
                                <div class="col-sm-9">
                                    <input wire:model.defer="password" type="password" class="form-control">
                                    @error('password')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- NIP BPS --}}
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">NIP BPS</label>
                                <div class="col-sm-9">
                                    <input wire:model.defer="bpsid" type="number" class="form-control">
                                    @error('bpsid')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Satuan Kerja --}}
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Satuan Kerja</label>
                                <div class="col-sm-9">
                                    <select wire:model="unit" class="form-control mb-3">
                                        @foreach($satker as $index => $item)
                                            <option value="{{ $index + 1 }}">{{ $item->kode_satker }} - BPS {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Hak Akses --}}
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Role/Hak Akses</label>
                                <div class="col-sm-9">
                                    <select wire:model="role" class="form-control mb-3">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->kode_akses }}">{{ $role->nama_akses }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Foto --}}
                            <div class="form-group row">
                                <label for="fileInput" class="col-sm-3 form-control-label">
                                    Foto Profil
                                    <sup class="badge badge-rounded bg-primary text-white">opsional</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input wire:model.defer="photo" type="file" class="form-control-file" accept="image/*">
                                    @error('photo')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex">
                            <span class="w-100"></span>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
