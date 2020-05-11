@extends('home')

@section('title', 'Pengaturan Pengguna')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Pengguna Aplikasi</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid d-flex">
            <span class="w-100"></span>
            <div class="form-group">
                <a href="{{ route('pengguna.tambah') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Daftar Pengguna Aplikasi Spatula</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NIP BPS</th>
                                    <th>Role</th>
                                    <th>Aktif</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count() > 0)
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">{{ $index + 1 }}</a>
                                            </th>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">{{ $user->nama }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">{{ $user->email }}</a>
                                            </td>
                                            <td class="align-middle">
                                                @if(!is_null($user->bpsid))
                                                    <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">{{ $user->bpsid }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">
                                                    @include('components.role', ['role_id' => $user->role_id ])
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('pengguna.edit', $user->id) }}">
                                                    @include('components.active', ['active' => $user->aktif ])
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('pengguna.hapus', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-sm btn-danger float-right" type="submit" value="Hapus"/>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
