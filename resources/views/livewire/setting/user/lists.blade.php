@section('title', 'Pengaturan User')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Pengguna Aplikasi</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid d-flex">
            <span class="w-100"></span>
            @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                <div class="form-group">
                    <a href="{{ url(env('APP_URL') . '/setting/user/create') }}" class="btn btn-primary">Tambah</a>
                </div>
            @endif
        </div>

        <div class="container-fluid">
            @include('components.notification.flash')
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>NIP BPS</th>
                                    <th>Role</th>
                                    <th>Satuan Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count() > 0)
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td class="align-middle">
                                                <span class="text-dark">{{ $user->nama }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">{{ $user->username }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">{{ $user->bpsid ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">{{ $user->role->nama_akses }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark">BPS {{ $user->satker()->first()->nama }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="{{ url(env('APP_URL') . '/setting/user/edit/' . $user->username) }}" class="btn btn-sm btn-primary ml-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{-- @if(Auth::user()->role_id <= 2)
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-sm btn-danger float-right ml-4" type="submit" value="Hapus"/>
                                                    </form>
                                                    <a class="btn btn-sm btn-primary float-right" href="{{ route('pengguna.edit', $user->id) }}">Ubah</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary float-right" href="{{ route('pengguna.edit', $user->id) }}">Ubah</a>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </section>
</div>
