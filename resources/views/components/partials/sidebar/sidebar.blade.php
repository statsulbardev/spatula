<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-56 flex-col overflow-y-hidden bg-gradient-to-b from-primary-500 to-fuchsia-700 duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    {{-- Sidebar Header --}}
    <div class="mx-auto pt-3 flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{ route('dashboard') }}" wire:navigate>
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
                    <x-partials.sidebar.menu :route="route('dashboard')"
                        :path="request()->is('dashboard') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                        icon="squares-2x2-solid" page="Dashboard" title="Dashboard" />

                    {{-- Verifikasi --}}
                    @role('superadmin|admin|pj-layanan|pj-pengaduan')
                        <x-partials.sidebar.collapse-menu page="Verification" icon="square-3-stack-3d-solid" label="Verifikasi"
                            :class="request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            :verticalborder="request()->is('verifikasi/*') ? '' : 'opacity-50'">
                            <x-partials.sidebar.submenu :route="route('daftar-selesai')" title="Layanan"
                                :path="request()->is('verifikasi/selesai') || request()->is('verifikasi/selesai/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />

                            <x-partials.sidebar.submenu :route="route('daftar-pj-layanan')" title="Permintaan"
                                :path="request()->is('verifikasi/pj-layanan') || request()->is('verifikasi/pj-layanan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />

                            <x-partials.sidebar.submenu :route="route('daftar-pj-pengaduan')" title="Pengaduan"
                                :path="request()->is('verifikasi/pj-pengaduan') || request()->is('verifikasi/pj-pengaduan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />
                        </x-partials.sidebar.collapse-menu>
                    @endrole

                    {{-- Laporan --}}
                    @role('superadmin|admin|pimpinan')
                        <x-partials.sidebar.collapse-menu page="Report" icon="presentation-chart-line-solid" label="Laporan"
                            :class="request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            :verticalborder="request()->is('laporan/*') ? '' : 'opacity-50'">
                            <x-partials.sidebar.submenu :route="route('laporan-bulanan')" title="Bulanan"
                                :path="request()->is('laporan/bulanan') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />

                            <x-partials.sidebar.submenu :route="route('laporan-harian')" title="Harian"
                                :path="request()->is('laporan/harian') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />
                        </x-partials.collapse-menu>
                    @endrole

                    @role('superadmin|admin|pj-antrian|operator-antrian')
                        <x-partials.sidebar.collapse-menu page="Queue" icon="queue-list-solid" label="Antrian"
                            :class="request()->is('pengaturan/antrian/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            :verticalborder="request()->is('pengaturan/antrian/*') ? '' : 'opacity-50'">
                            @role('superadmin|admin|pj-antrian')
                            <x-partials.sidebar.submenu :route="route('antrian-daftar-layanan')" title="Daftar Layanan"
                                :path="request()->is('pengaturan/antrian/daftar-layanan') || request()->is('pengaturan/antrian/daftar-layanan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />

                            <x-partials.sidebar.submenu :route="route('antrian-config-view')" title="Konfigurasi"
                                :path="request()->is('pengaturan/antrian/config_view') || request()->is('pengaturan/antrian/config_view/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />
                            @endrole

                            <x-partials.sidebar.submenu :route="route('antrian-caller')" title="Pemanggil"
                                :path="request()->is('pengaturan/antrian/caller') || request()->is('pengaturan/antrian/caller/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />

                            <x-partials.sidebar.submenu :route="route('antrian-daftar')" title="Daftar Antrian"
                                :path="request()->is('pengaturan/antrian/daftar') || request()->is('pengaturan/antrian/daftar/*') ? 'text-white' : 'text-primary-100 group-hover:text-white'" />
                        </x-partials.sidebar.collapse-menu>
                    @endrole
                </div>
            </div>

            {{-- Configuration Group --}}
            <div>
                <h3 class="mb-4 text-sm font-medium text-white opacity-80">PENGATURAN</h3>
                @role('superadmin')
                    <div class="flex flex-col gap-4">
                        {{-- Pengaturan Layanan --}}
                        <x-partials.sidebar.menu :route="route('service.index')"
                            :path="request()->routeIs('service.*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            icon="clipboard-document-list-solid" page="Service" title="Layanan" />

                        {{-- Pengaturan User --}}
                        <x-partials.sidebar.menu :route="route('user.index')"
                            :path="request()->routeIs('user.*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            icon="user-circle-solid" page="User" title="Pengguna" />

                        {{-- Pengaturan Satker --}}
                        <x-partials.sidebar.menu :route="route('unit.index')"
                            :path="request()->routeIs('unit.*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            icon="building-office-solid" page="Unit" title="Satuan Kerja" />
                    </div>
                @endrole

                @role('admin')
                    <div class="flex flex-col gap-4">
                        {{-- Pengaturan Layanan --}}
                        <x-partials.sidebar.menu :route="route('service.index')"
                            :path="request()->routeIs('service.*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            icon="clipboard-document-list-solid" page="Service" title="Layanan" />

                        {{-- Pengaturan User --}}
                        <x-partials.sidebar.menu :route="route('user.index')"
                            :path="request()->routeIs('user.*') ? 'text-white' : 'text-primary-100 group-hover:text-white'"
                            icon="user-circle-solid" page="User" title="Pengguna" />
                    </div>
                @endrole
            </div>
        </nav>
    </div>
</aside>
