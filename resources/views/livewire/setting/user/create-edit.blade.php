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
                                        <option>- Pilih Salah Satu -</option>
                                        @foreach($satker as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode_satker }} - BPS {{ $item->nama }}</option>
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
                                        <option>- Pilih Salah Satu -</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->nama_akses }}</option>
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
                                    <input wire:change="$emit('file')" id="filePhoto" type="file" class="form-control-file" accept="image/*">
                                    @if (!is_null($urlPhoto))
                                    <div class="d-flex align-items-center">
                                        <img src="{{ secure_asset(env('APP_URL') . '/public/files/image/' . $urlPhoto) }}" alt="Foto" class="mt-2 shadow rounded" width="50">
                                        <p class="ml-2 h6 text-muted">{{ $urlPhoto }}</p>
                                    </div>
                                    @endif

                                    @error('photo')
                                        <span class="mt-4 alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex">
                            <span class="w-100">
                                <button class="btn btn-danger" wire:click.prevent="deleteId()" data-toggle="modal" data-target="#deleteSpecificModal">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </span>
                            <button class="btn btn-primary d-flex align-items-center">
                                <i class="fa fa-save"></i>
                                <span class="ml-2">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bootstrap Modal --}}
        <div wire:ignore.self class="modal fade" id="deleteSpecificModal" tabindex="-1" role="dialog" aria-labelledby="deleteSpecificModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSpecificModalLabel">Hapus Informasi Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda ingin menghapus data pengguna ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    window.livewire.on('file', () => {
        let inputField = document.getElementById('filePhoto')
        let file       = inputField.files[0]
        let extension  = inputField.files[0].name.split('.').pop().toLowerCase()
        let reader     = new FileReader()

        reader.onloadend = () => {
            window.livewire.emit('photo', reader.result)
            window.livewire.emit('photoExtension', extension)
        }

        reader.readAsDataURL(file)
    });
</script>
@endpush
