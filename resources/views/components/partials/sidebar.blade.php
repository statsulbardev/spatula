<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-56 flex-col overflow-y-hidden bg-gradient-to-b from-primary-500 to-fuchsia-700 duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    {{-- Sidebar Header --}}
    <div class="mx-auto pt-3 flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{ route('dashboard') }}" data-turbo-action="replace">
            <div class="fill-white">
                @include('components.logo.logo', ['width' => 150, 'height' => 36.728])
            </div>
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-white" width="15" height="13" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>

    {{-- Sidebar Menu --}}
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav class="mt-5 ml-4 px-4 py-4 lg:mt-9 lg:px-6 flex flex-col gap-10" x-data="{ selected: $persist('Dashboard') }">
            {{-- Menu Group --}}
            <div class="mt-5">
                <h3 class="mb-4 text-sm font-medium text-white opacity-80">MENU</h3>
                <div class="flex flex-col gap-4">
                    {{-- Dashbboard --}}
                    <a class="cursor-pointer flex gap-2 mt-1"
                        href="{{ route('dashboard') }}"
                        @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                        data-turbo-action="replace">
                        <span
                            class="{{ request()->is('dashboard') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} mr-2 h-4 w-4">
                            @include('components.icons.heroline', ['name' => 'squares-2x2', 'size' => 'w-5 h-5'])
                        </span>
                        <span
                            class="{{ request()->is('dashboard') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm font-medium tracking-wider">
                            Dashboard</span>
                    </a>

                    {{-- Verifikasi --}}
                    @role('superadmin|admin|pj-layanan|pj-pengaduan')
                        <div class="cursor-pointer">
                            <div class="group relative flex gap-3 items-center
                                        {{ request()->is('verifikasi/*')
                                                ? 'text-white'
                                                : 'text-primary-100 group-hover:text-white'
                                        }}"
                                @click.prevent="selected = (selected === 'Verification' ? '':'Verification')">
                                @include('components.icons.heroline', ['name' => 'square-3-stack-3d', 'size' => 'w-5 h-5'])
                                <span class="text-sm font-medium tracking-wider w-1/2">Verifikasi</span>
                                @include('components.icons.heroline', ['name' => 'chevron-down', 'size' => 'w-4 h-4', 'page' => 'Verification'])
                            </div>
                            <div class="flex flex-row" :class="(selected === 'Verification') ? 'mt-2' : ''">
                                <span class="border-l border-white border-1 ml-2 {{ request()->is('verifikasi/*') ? '' : 'opacity-50' }}"></span>
                                <ul class="flex flex-col gap-1" :class="(selected === 'Verification') ? 'block' : 'hidden'">
                                    <li class="group flex items-center">
                                        <span class="mr-2 h-4 w-4"></span>
                                        <a class="{{ request()->is('verifikasi/selesai') || request()->is('verifikasi/selesai/*')
                                                        ? 'text-white'
                                                        : 'text-primary-100 group-hover:text-white'
                                                    }} text-sm"
                                            href="{{ route('daftar-selesai') }}"
                                            data-turbo-action="replace">
                                            Selesai
                                        </a>
                                    </li>
                                    <li class="group flex items-center">
                                        <span class="mr-2 h-4 w-4"></span>
                                        <a class="{{ request()->is('verifikasi/pj-layanan') || request()->is('verifikasi/pj-layanan/*')
                                                        ? 'text-white'
                                                        : 'text-primary-100 group-hover:text-white'
                                                    }} text-sm"
                                            href="{{ route('daftar-pj-layanan') }}"
                                            data-turbo-action="replace">
                                            PJ Layanan
                                        </a>
                                    </li>
                                    <li class="group flex items-center">
                                        <span class="mr-2 h-4 w-4"></span>
                                        <a class="{{ request()->is('verifikasi/pj-pengaduan') || request()->is('verifikasi/pj-pengaduan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                            href="{{ route('daftar-pj-pengaduan') }}"
                                            data-turbo-action="replace">
                                            PJ Pengaduan
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    @endrole

                    {{-- Laporan --}}
                    @role('superadmin|admin|pimpinan')
                    <div class="cursor-pointer">
                        <div class="group relative flex gap-3 items-center {{ request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}"
                            @click.prevent="selected = (selected === 'Report' ? '':'Report')">
                            @include('components.icons.heroline', ['name' => 'presentation-chart-line', 'size' => 'w-5 h-5'])
                            <span class="text-sm font-medium tracking-wider w-1/2">Laporan</span>
                            @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-4 h-4'])
                        </div>
                        <div class="flex flex-row" :class="(selected === 'Report') ? 'mt-2' : ''">
                            <span class="border-l border-white border-1 ml-2 {{ request()->is('laporan/*') ? '' : 'opacity-50' }}"></span>
                            <ul class="flex flex-col gap-1" :class="(selected === 'Report') ? 'block' : 'hidden'">
                                <li class="group flex items-center">
                                    <span class="mr-2 h-4 w-4"></span>
                                    <a class="{{ request()->is('laporan/bulanan')
                                                    ? 'text-white'
                                                    : 'text-primary-100 group-hover:text-white'
                                                }} text-sm"
                                        href="{{ route('laporan-bulanan') }}"
                                        data-turbo-action="replace">
                                        Bulanan
                                    </a>
                                </li>
                                <li class="group flex items-center">
                                    <span class="mr-2 h-4 w-4"></span>
                                    <a class="{{ request()->is('laporan/harian')
                                                    ? 'text-white'
                                                    : 'text-primary-100 group-hover:text-white'
                                                }} text-sm"
                                        href="{{ route('laporan-harian') }}"
                                        data-turbo-action="replace">
                                        Harian
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endrole

                    @role('admin|pj-antrian|operator-antrian')
                        <div class="cursor-pointer">
                            <div class="group relative flex gap-3 items-center {{ request()->is('pengaturan/antrian/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}"
                                @click.prevent="selected = (selected === 'Antrian' ? '':'Antrian')">
                                @include('components.icons.heroline', ['name' => 'list-bullet', 'size' => 'w-5 h-5'])
                                <span class="text-sm font-medium tracking-wider w-1/2">Antrian</span>
                                @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-4 h-4'])
                            </div>
                            <div class="flex flex-row" :class="(selected === 'Antrian') ? 'mt-2' : ''">
                                <span class="border-l border-white border-1 ml-2 {{ request()->is('pengaturan/antrian/*') ? '' : 'opacity-50' }}"></span>
                                <ul class="flex flex-col gap-1" :class="(selected === 'Antrian') ? 'block' : 'hidden'">
                                    @role('admin|pj-antrian')
                                        <li class="group flex items-center">
                                            <span class="mr-2 h-4 w-4"></span>
                                            <a class="{{ request()->is('pengaturan/antrian/daftar-layanan') || request()->is('pengaturan/antrian/daftar-layanan/*')
                                                            ? 'text-white'
                                                            : 'text-primary-100 group-hover:text-white'
                                                        }} text-sm"
                                                href="{{ route('antrian-daftar-layanan') }}"
                                                data-turbo-action="replace">
                                                Daftar Layanan
                                            </a>
                                        </li>
                                        <li class="group flex items-center">
                                            <span class="mr-2 h-4 w-4"></span>
                                            <a class="{{ request()->is('pengaturan/antrian/config_view') || request()->is('pengaturan/antrian/config_view/*')
                                                            ? 'text-white'
                                                            : 'text-primary-100 group-hover:text-white'
                                                        }} text-sm"
                                                href="{{ route('antrian-config-view') }}"
                                                data-turbo-action="replace">
                                                Konfigurasi
                                            </a>
                                        </li>
                                    @endrole
                                    <li class="group flex items-center">
                                        <span class="mr-2 h-4 w-4"></span>
                                        <a class="{{ request()->is('pengaturan/antrian/daftar') || request()->is('pengaturan/antrian/daftar/*')
                                                        ? 'text-white'
                                                        : 'text-primary-100 group-hover:text-white'
                                                    }} text-sm"
                                            href="{{ route('antrian-daftar') }}"
                                            data-turbo-action="replace">
                                            Daftar
                                        </a>
                                    </li>
                                    <li class="group flex items-center">
                                        <span class="mr-2 h-4 w-4"></span>
                                        <a class="{{ request()->is('pengaturan/antrian/caller') || request()->is('pengaturan/antrian/caller/*') 
                                                ? 'text-white' 
                                                : 'text-primary-100 group-hover:text-white' }} text-sm"
                                            href="{{ route('antrian-caller') }}"
                                            data-turbo-action="replace">
                                            Pemanggil
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    @endrole
                </div>
            </div>

            {{-- Configuration Group --}}
            <div>
                <h3 class="mb-4 text-sm font-medium text-white opacity-80">PENGATURAN</h3>

                @role('superadmin')
                    {{-- Pengaturan Layanan --}}
                    <div class="flex flex-col gap-4">
                        <a class="cursor-pointer flex gap-2 mt-1"
                            href="{{ route('daftar-layanan') }}"
                            @click="selected = (selected === 'Service' ? '':'Service')"
                            data-turbo-action="replace">
                            <span
                                class="{{ request()->is('pengaturan/layanan') || request()->is('pengaturan/layanan/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} mr-2 h-4 w-4">
                                @include('components.icons.heroline', ['name' => 'clipboard-document-list', 'size' => 'w-5 h-5'])
                            </span>
                            <span
                                class="{{ request()->is('pengaturan/layanan') || request()->is('pengaturan/layanan/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} text-sm font-medium tracking-wider">
                                Layanan
                            </span>
                        </a>

                        {{-- Pengaturan User --}}
                        <a class="cursor-pointer flex gap-2 mt-1"
                            href="{{ route('daftar-pengguna') }}"
                            @click="selected = (selected === 'User' ? '':'User')"
                            data-turbo-action="replace">
                            <span
                                class="{{ request()->is('pengaturan/pengguna') || request()->is('pengaturan/pengguna/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} mr-2 h-4 w-4">
                                @include('components.icons.heroline', ['name' => 'user-circle', 'size' => 'w-5 h-5'])
                            </span>
                            <span
                                class="{{ request()->is('pengaturan/pengguna') || request()->is('pengaturan/pengguna/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} text-sm font-medium tracking-wider">
                                Pengguna
                            </span>
                        </a>

                        {{-- Pengaturan Satker --}}
                        <a class="cursor-pointer flex gap-2 mt-1"
                            href="{{ route('daftar-satker') }}"
                            @click="selected = (selected === 'Unit' ? '':'Unit')"
                            data-turbo-action="replace">
                            <span
                                class="{{ request()->is('pengaturan/satker') || request()->is('pengaturan/satker/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} mr-2 h-4 w-4">
                                @include('components.icons.heroline', ['name' => 'building-office', 'size' => 'w-5 h-5'])
                            </span>
                            <span
                                class="{{ request()->is('pengaturan/satker') || request()->is('pengaturan/satker/*')
                                            ? 'text-white'
                                            : 'text-primary-100 group-hover:text-white'
                                        }} text-sm font-medium tracking-wider">
                                Satuan Kerja
                            </span>
                        </a>
                    </div>
                @endrole

                @role('admin')
                    <a class="cursor-pointer flex gap-2 mt-1"
                        href="{{ route('daftar-pengguna') }}"
                        @click="selected = (selected === 'User' ? '':'User')"
                        data-turbo-action="replace">
                        <span class="
                            {{ request()->is('pengaturan/pengguna') || request()->is('pengaturan/pengguna/*')
                                ? 'text-white'
                                : 'text-primary-100 group-hover:text-white'
                            }} mr-2 h-4 w-4">
                            @include('components.icons.heroline', ['name' => 'user-circle', 'size' => 'w-5 h-5'])
                        </span>
                        <span class="
                            {{ request()->is('pengaturan/pengguna') || request()->is('pengaturan/pengguna/*')
                                ? 'text-white'
                                : 'text-primary-100 group-hover:text-white'
                            }} text-sm font-medium tracking-wider">
                            Atur Pengguna
                        </span>
                    </a>
                @endrole
            </div>
        </nav>
    </div>
</aside>
