<header class="header">
    <nav class="navbar">
        <!-- Search Box-->
        <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
                <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
        </div>
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <!-- Navbar Header-->
                <div class="navbar-header">
                    <!-- Navbar Brand -->
                    <a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                        <div class="brand-text d-none d-lg-inline-block"><strong>SPATULA</strong></div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                    </a>
                    <span class="ml-4 mr-3"></span>
                    <span class="ml-4"></span>
                    <!-- Toggle Button-->
                    <a wire:ignore id="toggle-btn" href="#" class="menu-btn active">
                        <span></span><span></span><span></span>
                    </a>
                    <span class="ml-2">
                        Saran Pengaduan Online dan Rating Petugas Layanan
                    </span>
                </div>
                <!-- Navbar Menu -->
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    {{-- <!-- Search-->
                    <li class="nav-item d-flex align-items-center mr-3"><a id="search" href="#"><i class="icon-search"></i></a></li> --}}
                    <!-- Logout    -->
                    <li class="nav-item">
                        <livewire:auth.logout/>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
