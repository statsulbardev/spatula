@extends('home')

@section('title', 'Pengaturan Petugas')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Petugas Layanan</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid d-flex">
            <span class="w-100"></span>
            <div class="form-group">
                <a href="{{ route('petugas.tambah') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Daftar Petugas Layanan</h4>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($opertors->count() > 0)
                                    @foreach($operators as $index => $operator)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                <a class="text-dark" href="{{ route('petugas.edit', $operator->id) }}">{{ $index + 1 }}</a>
                                            </th>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('petugas.edit', $operator->id) }}">{{ $operator->nama }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('petugas.edit', $operator->id) }}">{{ $operator->email }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{ route('petugas.edit', $operator->id) }}">{{ $operator->bps_id }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('pengguna.hapus', $operator->id) }}" method="POST">
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
