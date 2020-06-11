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
                    request()->is('tindak-lanjut/kirim/*') ||
                    request()->is('tindak-lanjut/konfirmasi-pj-pengaduan') ||
                    request()->is('tindak-lanjut/kirim-pengaduan/*'))
                    aria-expanded="true"
                @else
                    aria-expanded="false"
                @endif
                data-toggle="collapse">
                <i class="icon-website"></i>Tindak Lanjut
            </a>
            <ul id="tindakLanjut" class="collapse list-unstyled
                {{
                    request()->is('tindak-lanjut/selesai') ||
                    request()->is('tindak-lanjut/selesai/*') ||
                    request()->is('tindak-lanjut/konfirmasi-pj-layanan') ||
                    request()->is('tindak-lanjut/kategorisasi/*') ||
                    request()->is('tindak-lanjut/kirim/*') ||
                    request()->is('tindak-lanjut/konfirmasi-pj-pengaduan') ||
                    request()->is('tindak-lanjut/kirim-pengaduan/*') ?
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
                <li class="{{
                    request()->is('tindak-lanjut/konfirmasi-pj-pengaduan') ||
                    request()->is('tindak-lanjut/kirim-pengaduan/*') ? 'active' : '' }}">
                    <a href="{{ route('followup.complaint') }}">Konfirmasi PJ Pengaduan</a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->role_id <= 6)
            <li>
                <a href="#laporan"
                    @if(request()->is('laporan/bulanan') ||
                        request()->is('laporan/harian'))
                        aria-expanded="true"
                    @else
                        aria-expanded="false"
                    @endif
                    data-toggle="collapse">
                    <i class="icon-form"></i>Laporan
                </a>
                <ul id="laporan" class="collapse list-unstyled {{
                        request()->is('laporan/bulanan') ||
                        request()->is('laporan/harian') ?
                        'show' : ''
                    }}
                ">
                    <li class="{{ request()->is('laporan/bulanan') ? 'active' : '' }}">
                        <a href="{{ route('report.monthly') }}">Bulanan</a>
                    </li>
                    <li class="{{ request()->is('laporan/harian') ? 'active' : '' }}">
                        <a href="{{ route('report.daily') }}">Harian</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <span class="heading">Pengaturan</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('pengguna') || request()->is('pengguna/*') ? 'active' : '' }}">
            <a href="{{ route('pengguna') }}">
                <i class="icon-user"></i>Pengguna
            </a>
        </li>
        @if(Auth::user()->role_id <= 2)
            <li class="{{ request()->is('petugas') || request()->is('petugas/*') ? 'active' : '' }}">
                <a href="{{ route('petugas') }}">
                    <i class="icon-list"></i> Petugas
                </a>
            </li>
        @endif
        <li class="{{ request()->is('tautan') ? 'active' : '' }}">
            <a href="{{ route('tautan') }}">
                <i class="icon-interface-windows"></i> Tautan/Link
            </a>
        </li>
    </ul>
</nav>
