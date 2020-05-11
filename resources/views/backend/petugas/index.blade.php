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
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($operators->count() > 0)
                                    @foreach($operators as $index => $operator)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                <a class="text-dark">{{ $index + 1 }}</a>
                                            </th>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $operator->nama }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $operator->email }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $operator->bpsid }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">
                                                    @include('components.active', ['active' => $operator->aktif])
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('petugas.update', $operator->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    @if($operator->aktif)
                                                        <button name="state" class="btn btn-sm btn-danger float-right" type="submit" value="0">Non Aktifkan</button>
                                                    @else
                                                        <button name="state" class="btn btn-sm btn-primary float-right" type="submit" value="1">Aktifkan</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $operators->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
