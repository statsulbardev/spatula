<!-- Side Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            @if($photo)
                <img src="{{ $photo }}" alt="..." class="img-fluid rounded-circle">
            @else
                <img src="{{ \Illuminate\Support\Facades\Storage::url('public/user.png')}}" alt="..." class="img-fluid rounded-circle">
            @endif
        </div>
        <div class="title">
            <h1 class="h4">{{ $username }}</h1>
            <p>
                @include('components.role', ['role_id' => $role ])
            </p>
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
            <a href="#tindakLanjut" aria-expanded="false" data-toggle="collapse">
                <i class="icon-interface-windows"></i>Tindak Lanjut
            </a>
            <ul id="tindakLanjut" class="collapse list-unstyled ">
                <li><a href="#">Selesai</a></li>
                <li><a href="#">Konfirmasi PJ Layanan</a></li>
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
        <li class="{{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
            <a href="{{ route('users') }}">
                <i class="icon-user"></i>Pengguna
            </a>
        </li>
    </ul>
</nav>
