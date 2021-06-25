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
            @if(Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                <div class="form-group">
                    <a href="{{ route('pengguna.tambah') }}" class="btn btn-primary">Tambah</a>
                </div>
            @endif
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>NIP BPS</th>
                                    <th>Role</th>
                                    <th>Satuan Kerja</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count() > 0)
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                <span class="text-dark">
                                                    {{ $index + 1 }}
                                                </span>
                                            </th>
                                            <td class="align-middle">
                                                <span class="text-dark">
                                                    {{ $user->nama }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">
                                                    {{ $user->username }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">
                                                    {{ $user->email }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                @if(!is_null($user->bpsid))
                                                    <span class="text-dark">
                                                        {{ $user->bpsid }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">
                                                    {{ $user->role->nama_akses }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">
                                                    BPS {{ $user->satker()->first()->nama }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                @if(Auth::user()->role_id <= 2)
                                                    <form action="{{ route('pengguna.hapus', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-sm btn-danger float-right ml-4" type="submit" value="Hapus"/>
                                                    </form>
                                                    <a class="btn btn-sm btn-primary float-right" href="{{ route('pengguna.edit', $user->id) }}">Ubah</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary float-right" href="{{ route('pengguna.edit', $user->id) }}">Ubah</a>
                                                @endif
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
