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
                                    @foreach($users as $user)
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
                                                <a href="{{ url(env('APP_URL') . '/setting/user/edit/' . $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" wire:click="deleteId({{ $user->id }})" class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#deleteModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- Paginate --}}
                </div>
            </div>
        </div>

        {{-- Bootstrap Modal --}}
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Informasi Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda ingin menghapus data pengguna ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" wire:click.prevent="delete()" id="btn-modal-delete" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
