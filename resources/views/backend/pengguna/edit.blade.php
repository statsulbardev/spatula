@extends('home')

@section('title', 'Edit Data Pengguna')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ route('pengguna') }}" style="color:#796AEE" class="h2 no-margin-bottom">
                Pengguna Aplikasi /
            </a>
            <span class="h2 no-margin-bottom">{{ $user->nama }}</span>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Isikan Informasi Pengguna Aplikasi</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('pengguna.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">
                                    Nama Lengkap
                                    <sup class="badge badge-rounded bg-primary text-white">wajib</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input name="fullname" type="text" class="form-control" value="{{ $user->nama }}">
                                    @error('fullname')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">
                                    Username
                                    <sup class="badge badge-rounded bg-primary text-white">wajib</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input name="username" type="text" class="form-control" value="{{ $user->username }}">
                                    @error('username')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">
                                    Email
                                    <sup class="badge badge-rounded bg-primary text-white">wajib</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">
                                    Password
                                    <sup class="badge badge-rounded bg-primary text-white">wajib</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">NIP BPS</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bpsid" class="form-control" value="{{ $user->bpsid }}">
                                    @error('bpsid')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Satuan Kerja</label>
                                <div class="col-sm-9">
                                    <select name="satker" class="form-control mb-3">
                                        @foreach ($satker as $index => $item)
                                            <option value="{{ $index + 1 }}" {{ ( ($index+1) === $selected_satker) ? 'selected' : '' }}>{{ $item->kode_satker }} - BPS {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Role/Hak Akses</label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control mb-3">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->kode_akses }}" {{ ( $role->kode_akses === $selected_role) ? 'selected' : '' }}>{{ $role->nama_akses }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileInput" class="col-sm-3 form-control-label">
                                    Foto Profil
                                </label>
                                <div class="col-sm-9">
                                    <input name="photo" type="file" class="form-control-file" accept="image/*">
                                    @error('photo')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex">
                                <span class="w-100"></span>
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
