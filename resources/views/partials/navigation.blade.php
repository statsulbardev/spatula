<!-- Side Navbar -->
<nav id="sidenav" class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            @if(Auth::user()->foto)
                <img src="{{ Auth::user()->foto }}" alt="..." class="img-fluid rounded-circle">
            @else
                <img src="{{ asset('storage/user.png') }}" alt="..." class="img-fluid rounded-circle">
            @endif
        </div>
        <div class="title">
            <h1 class="h4">{{ Auth::user()->nama }}</h1>
            <p>{{ Auth::user()->role->nama_akses }}</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus-->
    <span class="heading">Utama</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="icon-home"></i>Beranda
            </a>
        </li>
        <li>
            <a href="#tindakLanjut"
                @if(request()->is('tindak-lanjut/selesai') ||
                    request()->is('tindak-lanjut/selesai/*') ||
                    request()->is('tindak-lanjut/konfirmasi-pj-layanan') ||
                    request()->is('tindak-lanjut/kategorisasi/*') ||
                    request()->is('tindak-lanjut/kirim/*'))
                    aria-expanded="true"
                @else
                    aria-expanded="false"
                @endif
                data-toggle="collapse">
                <i class="icon-interface-windows"></i>Tindak Lanjut
            </a>
            <ul id="tindakLanjut" class="collapse list-unstyled
                {{
                    request()->is('tindak-lanjut/selesai') ||
                    request()->is('tindak-lanjut/selesai/*') ||
                    request()->is('tindak-lanjut/konfirmasi-pj-layanan') ||
                    request()->is('tindak-lanjut/kategorisasi/*') ||
                    request()->is('tindak-lanjut/kirim/*') ?
                    'show' : ''
                }}
            ">
                <li class="{{
                    request()->is('tindak-lanjut/selesai') ||
                    request()->is('tindak-lanjut/selesai/*') ? 'active' : '' }}">
                    <a href="{{ route('followup.done') }}">Selesai</a>
                </li>
                <li class="{{
                    request()->is('tindak-lanjut/konfirmasi-pj-layanan') ||
                    request()->is('tindak-lanjut/kategorisasi/*') ||
                    request()->is('tindak-lanjut/kirim/*') ? 'active' : '' }}">
                    <a href="{{ route('followup.service') }}">Konfirmasi PJ Layanan</a>
                </li>
                <li><a href="#">Konfirmasi PJ Pengaduan</a></li>
            </ul>
        </li>
        <li>
            <a href="#laporan" aria-expanded="false" data-toggle="collapse">
                <i class="icon-interface-windows"></i>Laporan
            </a>
            <ul id="laporan" class="collapse list-unstyled ">
                <li><a href="#">Bulanan</a></li>
                <li><a href="#">Harian</a></li>
            </ul>
        </li>
    </ul>

    <span class="heading">Pengaturan</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('pengguna') || request()->is('pengguna/*') ? 'active' : '' }}">
            <a href="{{ route('pengguna') }}">
                <i class="icon-user"></i>Pengguna
            </a>
        </li>
        <li class="{{ request()->is('petugas') || request()->is('petugas/*') ? 'active' : '' }}">
            <a href="{{ route('petugas') }}">
                <i class="icon-list"></i> Petugas
            </a>
        </li>
        <li>
            <a href="">
                <i class="icon-interface-windows"></i> Tautan/Link
            </a>
        </li>
    </ul>
</nav>
