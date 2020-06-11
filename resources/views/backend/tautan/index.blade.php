@extends('home')

@section('title', 'Daftar Tautan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Tautan Form Penilaian</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid d-flex">
            <span class="w-100"></span>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Daftar Tautan / URL Form Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Form</th>
                                    <th>Jenis Layanan</th>
                                    <th>Tautan/Url</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="7" class="align-middle">
                                        <span>Penilaian Petugas Layanan</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>Semua Layanan</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Konsultasi dan Rekomendasi Statistik</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/1</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Konsultasi Pengguna Data</span>
                                    </td>
                                    <td class="align-middle">
                                        <a>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/2</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Perpustakaan Tercetak</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/3</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Perpustakaan Digital</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/4</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Penjualan Buku</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/5</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Mikro/Peta Digital/Softcopy Publikasi</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/petugas/6</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="align-middle">
                                        <span>Penilaian Layanan</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>Semua Layanan</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/layanan</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Website</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/layanan/7</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Email</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/layanan/8</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Chat Us</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/layanan/9</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span>Whatsapp</span>
                                    </td>
                                    <td class="align-middle">
                                        <span>http://bpssulbar.id/spatula/penilaian/{kode_satker}/layanan/10</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
