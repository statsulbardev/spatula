@section('title', 'Pengaturan Petugas')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Petugas Layanan</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid">
            @include('components.notification.flash')
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
                                    <th>Nama</th>
                                    <th>Satuan Kerja</th>
                                    <th>NIP BPS</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($operators->count() > 0)
                                    @foreach($operators as $operator)
                                        <tr>
                                            <td class="align-middle">
                                                <a class="text-dark">{{ $operator->nama }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark">BPS {{ $operator->satker->nama }}</a>
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
                                                @if($operator->aktif)
                                                    <button wire:click="update({{ $operator->id }}, 0)" class="btn btn-sm btn-danger float-right" type="submit">Non Aktifkan</button>
                                                @else
                                                    <button wire:click="update({{ $operator->id }}, 1)" class="btn btn-sm btn-primary float-right" type="submit">Aktifkan</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Tidak ditemukan informasi operator.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $operators->links() }} --}}
                </div>
            </div>
        </div>
    </section>
</div>
