@extends('home')

@section('title', 'Edit Data Pengguna')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <a href="{{ route('users') }}" style="color:#796AEE" class="h2 no-margin-bottom">Pengguna / </a>
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
                        <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input name="fullname" type="text" class="form-control" value="{{ $user->nama }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Username</label>
                                <div class="col-sm-9">
                                    <input name="username" type="text" class="form-control" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">NIP BPS</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bpsid" class="form-control" value="{{ $user->bpsid }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Role/Hak Akses</label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control mb-3">
                                        <option value="1">Superadmin</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Pengawas</option>
                                        <option value="4">Operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileInput" class="col-sm-3 form-control-label">
                                    Foto Profil
                                    <sup class="badge badge-rounded bg-primary text-white">opsional</sup>
                                </label>
                                <div class="col-sm-9">
                                    <input name="photo" type="file" class="form-control-file" accept="image/*">
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
