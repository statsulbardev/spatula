{{-- Menu Aplikasi --}}
<div class="px-4 space-y-5">
    <!-- SideBar Toggle -->
    <button
        @click="$store.sidebar.full = !$store.sidebar.full"
        class="hidden sm:block focus:outline-none absolute p-1 -right-3 top-4 bg-gray-800 rounded-full shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-all duration-300 text-white transform" x-bind:class="$store.sidebar.full ? 'rotate-90':'-rotate-90 '" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    {{-- Dashboard --}}
    <div
        x-data="tiptool"
        x-on:mouseover="show = true"
        x-on:mouseleave="show = false"
        @click="$store.sidebar.active = 'dashboard'"
        class="relative flex items-center hover:text-gray-200 hover:bg-primary-600 space-x-2 rounded-md p-2 cursor-pointer"
        x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full,'text-gray-200 bg-primary-600':$store.sidebar.active == 'dashboard','text-gray-400 ':$store.sidebar.active != 'dashboard'}">
        <a href="{{ url(env('APP_URL') . '/dashboard') }}">
            @include('components.icon', ['name' => 'home', 'size' => 'w-5 h-5'])
        </a>
        <h1 class="text-sm" x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">
            <a href="{{ url(env('APP_URL') . '/dashboard') }}">Dashboard</a>
        </h1>
    </div>

    {{-- Verifikasi --}}
    <div x-data="dropdown" class="relative">
        <!-- Dropdown head -->
        <div
            @click="toggle('verifikasi')"
            @click="$store.sidebar.active = 'verifikasi'"
            x-data="tooltip"
            x-on:mouseover="show = true"
            x-on:mouseleave="show = false"
            class="flex justify-between text-white hover:bg-primary-600 items-center space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{'justify-start':$store.sidebar.full, 'sm:justify-center':!$store.sidebar.full, 'text-gray-200 bg-primary-600':$store.sidebar.active == 'verifikasi','text-gray-400 ':$store.sidebar.active != 'verifikasi'}">
            <div class="relative flex space-x-2 items-center">
                @include('components.icon', ['name' => 'rectangle-stack', 'size' => 'w-5 h-5'])
                <h1 class="text-sm" x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">
                    Verifikasi
                </h1>
            </div>
            <svg x-cloak x-bind:class="$store.sidebar.full ? '':'sm:hidden'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        {{-- Dropdown Content --}}
        <div
            x-cloak
            x-show="open"
            @click.outside="open = false"
            x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
            class="text-white space-y-3">

            {{-- Submenu Selesai --}}
            <h1 class="hover:text-gray-300 cursor-pointer" x-bind:class="{'mt-2':$store.sidebar.full }">
                <a href="{{ url(env('APP_URL') . '/verifikasi/selesai') }}">Selesai</a>
            </h1>

            {{-- Submenu PJ Layanan --}}
            <h1 class="hover:text-gray-300 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/verifikasi/pj-layanan') }}">PJ Layanan</a>
            </h1>

            {{-- Submenu PJ Pengaduan --}}
            <h1 class="hover:text-gray-300 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/verifikasi/pj-pengaduan') }}">PJ Pengaduan</a>
            </h1>
        </div>
    </div>

    {{-- Laporan --}}
    <div x-data="dropdown" class="relative">
        <!-- Dropdown head -->
        <div
            @click="toggle('laporan')"
            @click="$store.sidebar.active = 'laporan'"
            x-data="tooltip"
            x-on:mouseover="show = true"
            x-on:mouseleave="show = false"
            class="flex justify-between text-white hover:bg-primary-600 items-center space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full, 'text-gray-200 bg-primary-600':$store.sidebar.active == 'laporan','text-gray-400 ':$store.sidebar.active != 'laporan'}">
            <div class="relative flex space-x-2 items-center">
                @include('components.icon', ['name' => 'presentation-chart', 'size' => 'w-5 h-5'])
                <h1 class="text-sm" x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">Laporan</h1>
            </div>
            <svg x-cloak x-bind:class="$store.sidebar.full ? '':'sm:hidden'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        {{-- Dropdown Content --}}
        <div
            x-cloak
            x-show="open"
            @click.outside="open = false"
            x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
            class="text-white space-y-3 ">

            {{-- Submenu Bulanan --}}
            <h1 class="hover:text-gray-300 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/laporan/bulanan') }}">Bulanan</a>
            </h1>

            {{-- Submenu Harian --}}
            <h1 class="hover:text-gray-300 cursor-pointer" x-bind:class="{ 'mt-2':$store.sidebar.full }">
                <a href="{{ url(env('APP_URL') . '/laporan/harian') }}">Harian</a>
            </h1>
        </div>
    </div>

    {{-- Pengaturan --}}
    <div x-data="dropdown" class="relative">
        <!-- Dropdown head -->
        <div
            @click="toggle('pengaturan')"
            @click="$store.sidebar.active = 'pengaturan'"
            x-data="tooltip"
            x-on:mouseover="show = true" x-on:mouseleave="show = false"
            class="flex justify-between text-white hover:bg-primary-600 items-center space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full, 'text-gray-200 bg-primary-600':$store.sidebar.active == 'pengaturan','text-gray-400 ':$store.sidebar.active != 'pengaturan'}">
            <div class="relative flex space-x-2 items-center">
                @include('components.icon', ['name' => 'cog', 'size' => 'w-5 h-5'])
                <h1 class="text-sm" x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">Pengaturan</h1>
            </div>
            <svg x-cloak x-bind:class="$store.sidebar.full ? '':'sm:hidden'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        <!-- Dropdown content -->
        <div
            x-cloak
            x-show="open"
            @click.outside="open = false"
            x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
            class="text-white space-y-3">
            {{-- Submenu --}}
            <h1 class="hover:text-gray-200 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/pengaturan/layanan') }}">Layanan</a>
            </h1>
            <h1 class="hover:text-gray-200 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/pengaturan/pengguna') }}">Pengguna</a>
            </h1>
            <h1 class="hover:text-gray-200 cursor-pointer">
                <a href="{{ url(env('APP_URL') . '/pengaturan/satker') }}">Satuan Kerja</a>
            </h1>
        </div>
    </div>

    {{-- Logout --}}
    <div
        x-data="tiptool"
        x-on:mouseover="show = true"
        x-on:mouseleave="show = false"
        @click="$store.sidebar.active = 'logout'"
        class="absolute bottom-4 text-white rounded-md p-2 cursor-pointer"
        x-bind:class="{'hover:bg-primary-600':!$store.sidebar.full, 'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full,'text-gray-200 bg-primary-600':$store.sidebar.active == 'logout','text-gray-400 ':$store.sidebar.active != 'logout'}">
        @livewire('auth.logout')
    </div>
</div>
