@extends('home')

@section('title', 'Panduan Penggunaan')

@section('inner-content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
        <h2 class="no-margin-bottom">Panduan Penggunaan Aplikasi</h2>
        </div>
    </header>

    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid mb-5">
            {{-- <iframe src="{{ asset('public/vendor/ViewerJS/#../../files/pdf/panduan.pdf') }}" class="w-100 p-1 border rounded shadow mb-5" style="display:block;height:100vh;" allowfullscreen webkitallowfullscreen></iframe> --}}
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor1">
                        <span>1.</span>
                        <span class="ml-2">Akses Backend dan Login</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor2">
                        <span>2.</span>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor3">
                        <span>3.</span>
                        <span class="ml-2">Tindak Lanjut Penanggungjawab Layanan</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor4">
                        <span>4.</span>
                        <span class="ml-2">Tindak Lanjut Penanggungjawab Pengaduan</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor5">
                        <span>5.</span>
                        <span class="ml-2">Tindak Lanjut yang Telah Selesai</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor6">
                        <span>6.</span>
                        <span class="ml-2">Laporan Bulanan</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor7">
                        <span>7.</span>
                        <span class="ml-2">Laporan Harian</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor8">
                        <span>8.</span>
                        <span class="ml-2">Pengaturan Pengguna</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-normal" href="#nomor81">
                        <span class="ml-4">8.1</span>
                        <span class="ml-2">Tambah Pengguna</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-normal" href="#nomor82">
                        <span class="ml-4">8.2</span>
                        <span class="ml-2">Ubah Pengguna</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-normal" href="#nomor83">
                        <span class="ml-4">8.3</span>
                        <span class="ml-2">Hapus Pengguna</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor9">
                        <span>9.</span>
                        <span class="ml-2">Pengaturan Petugas</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark font-weight-bold" href="#nomor10">
                        <span>10.</span>
                        <span class="ml-2">Tautan/Link</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="container-fluid mt-4 mb-5">
            <div class="mb-4">
                <p id="nomor1" class="h3">1. Akses Backend dan Login</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/u2fMw3dvPSQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor2" class="h3">2. Dashboard</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/Iq2nyhWafbE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor3" class="h3">3. Tindak Lanjut Penanggungjawab Layanan</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/eBaTR_E6ics" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor4" class="h3">4. Tindak Lanjut Penanggungjawab Pengaduan</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor5" class="h3">5. Tindak Lanjut yang Telah Selesai</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor6" class="h3">6. Laporan Bulanan</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/uzDus0wx70g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor7" class="h3">7. Laporan Harian</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/fntlNzLTPCk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor8" class="h3">8. Pengaturan Pengguna</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor81" class="h3">8.1 Tambah Pengguna</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor82" class="h3">8.2 Ubah Pengguna</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor83" class="h3">8.3 Hapus Pengguna</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor9" class="h3">9. Pengaturan Petugas</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <p id="nomor10" class="h3">10. Tautan/Link</p>
                <iframe class="w-75 p-1 border rounded shadow mb-5" style="display:block;height:75vh;" src="https://www.youtube.com/embed/e4u_ruDMi0c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen></iframe>
            </div>
        </div>
      </section>
@endsection
