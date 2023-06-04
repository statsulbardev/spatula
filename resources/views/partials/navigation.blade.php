<!-- Side Navbar -->
<nav id="sidenav" class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            @if (auth()->user()->foto)
                <img src="{{ auth()->user()->foto }}" alt="{{ auth()->user()->nama }}" class="img-fluid rounded">
            @else
                <img src="{{ secure_asset('/public/files/image/user.png') }}" alt="user"
                    class="img-fluid rounded-circle">
            @endif
        </div>
        <div class="title">
            <h1 class="h4">{{ Auth::user()->nama }}</h1>
            <p>BPS {{ Auth::user()->satker->nama }}</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus-->
    <span class="heading">Utama</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ url(env('APP_URL') . 'dashboard') }}">
                <i class="fa fa-home"></i>Beranda
            </a>
        </li>
        <li>
            <a href="#followUp"
                @if (request()->is('followup/done') ||
                        request()->is('followup/done/*') ||
                        request()->is('followup/konfirmasi-pj-layanan') ||
                        request()->is('followup/kategorisasi/*') ||
                        request()->is('followup/kirim/*') ||
                        request()->is('followup/konfirmasi-pj-pengaduan') ||
                        request()->is('followup/kirim-pengaduan/*')) aria-expanded="true"
                @else
                    aria-expanded="false" @endif
                data-toggle="collapse">
                <i class="icon-website"></i>Tindak Lanjut
            </a>
            <ul id="followUp"
                class="collapse list-unstyled
                {{ request()->is('followup/done') ||
                request()->is('followup/done/*') ||
                request()->is('followup/service/*') ||
                request()->is('followup/kategorisasi/*') ||
                request()->is('followup/kirim/*') ||
                request()->is('followup/konfirmasi-pj-pengaduan') ||
                request()->is('followup/kirim-pengaduan/*')
                    ? 'show'
                    : '' }}
            ">
                <li class="{{ request()->is('followup/done') || request()->is('followup/done/*') ? 'active' : '' }}">
                    <a href="{{ url(env('APP_URL') . 'tindak-lanjut/selesai') }}">Selesai</a>
                </li>
                <li
                    class="{{ request()->is('followup/service/*') ||
                    request()->is('followup/kategorisasi/*') ||
                    request()->is('followup/kirim/*')
                        ? 'active'
                        : '' }}">
                    <a href="{{ url(env('APP_URL') . 'tindak-lanjut/konfirmasi-pj-layanan') }}">Konfirmasi PJ
                        Layanan</a>
                </li>
                <li
                    class="{{ request()->is('tindak-lanjut/konfirmasi-pj-pengaduan') || request()->is('tindak-lanjut/kirim-pengaduan/*')
                        ? 'active'
                        : '' }}">
                    {{-- <a href="{{ route('followup.complaint') }}">Konfirmasi PJ Pengaduan</a> --}}
                    <a href="">Konfirmasi PJ Pengaduan</a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->role_id <= 6)
            <li>
                <a href="#laporan"
                    @if (request()->is('laporan/bulanan') || request()->is('laporan/harian')) aria-expanded="true"
                    @else
                        aria-expanded="false" @endif
                    data-toggle="collapse">
                    <i class="icon-form"></i>Laporan
                </a>
                <ul id="laporan"
                    class="collapse list-unstyled {{ request()->is('laporan/bulanan') || request()->is('laporan/harian') ? 'show' : '' }}
                ">
                    <li class="{{ request()->is('laporan/bulanan') ? 'active' : '' }}">
                        {{-- <a href="{{ route('report.monthly') }}">Bulanan</a> --}}
                        <a href="">Bulanan</a>
                    </li>
                    <li class="{{ request()->is('laporan/harian') ? 'active' : '' }}">
                        {{-- <a href="{{ route('report.daily') }}">Harian</a> --}}
                        <a href="">Harian</a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="{{ request()->is('panduan') ? 'active' : '' }}">
            {{-- <a href="{{ route('panduan') }}">
                <i class="icon-list-1"></i> Panduan
            </a> --}}
            <a href="">
                <i class="fa fa-book"></i> Panduan
            </a>
        </li>
    </ul>

    <span class="heading">Pengaturan</span>
    <ul class="list-unstyled">
        <li class="{{ request()->is('setting/user') || request()->is('setting/user/*') ? 'active' : '' }}">
            <a href="{{ url(env('APP_URL') . '/setting/user/lists') }}">
                <i class="fa fa-user"></i> Pengguna
            </a>
        </li>
        @if (Auth::user()->role_id <= 2)
            <li class="{{ request()->is('setting/officer') || request()->is('setting/officer/*') ? 'active' : '' }}">
                <a href="{{ url(env('APP_URL') . '/setting/officer/lists') }}">
                    <i class="fa fa-list"></i> Petugas
                </a>
            </li>
        @endif
        <li class="{{ request()->is('tautan') ? 'active' : '' }}">
            {{-- <a href="{{ route('tautan') }}">
                <i class="icon-interface-windows"></i> Tautan/Link
            </a> --}}
            <a href="">
                <i class="fa fa-globe"></i> Tautan
            </a>
        </li>
    </ul>
</nav>
