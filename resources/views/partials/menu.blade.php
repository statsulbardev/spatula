<aside>
    <nav class="flex flex-col gap-10" x-data="{ selected: $persist('Dashboard') }">
        {{-- Menu Group --}}
        <div>
            <h3 class="mb-4 text-sm font-medium text-white opacity-80">MENU</h3>
            <div class="flex flex-col gap-4">
                {{-- Dashbboard --}}
                <a class="cursor-pointer flex gap-2 mt-1" href="{{ route('dashboard') }}"
                    @click="selected = (selected === 'Dashboard' ? '':'Dashboard')" data-turbo-action="replace">
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
                    <div class="group relative flex gap-3 items-center {{ request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}"
                        @click.prevent="selected = (selected === 'Verification' ? '':'Verification')">
                        @include('components.icons.heroline', ['name' => 'square-3-stack-3d', 'size' => 'w-5 h-5'])
                        <span class="text-sm font-medium tracking-wider w-1/2">Verifikasi</span>
                        @include('components.icon', ['name' => 'chevron-right', 'size' => 'w-4 h-4'])
                    </div>
                    <div class="flex flex-row" :class="(selected === 'Verification') ? 'mt-2' : ''">
                        <div class="border-l border-white border-1 ml-2 {{ request()->is('verifikasi/*') ? '' : 'opacity-50' }}"></div>
                        <ul class="flex flex-col gap-1" :class="(selected === 'Verification') ? 'block' : 'hidden'">
                            <li class="group flex items-center">
                                <span class="mr-2 h-4 w-4"></span>
                                <a class="{{ request()->is('verifikasi/selesai') || request()->is('verifikasi/selesai/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                    href="{{ route('daftar-selesai') }}">
                                    Selesai
                                </a>
                            </li>
                            <li class="group flex items-center">
                                <span class="mr-2 h-4 w-4"></span>
                                <a class="{{ request()->is('verifikasi/pj-layanan') || request()->is('verifikasi/pj-layanan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                    href="{{ route('daftar-pj-layanan') }}">
                                    PJ Layanan
                                </a>
                            </li>
                            <li class="group flex items-center">
                                <span class="mr-2 h-4 w-4"></span>
                                <a class="{{ request()->is('verifikasi/pj-pengaduan') || request()->is('verifikasi/pj-pengaduan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                    href="{{ route('daftar-pj-pengaduan') }}">
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
                        @include('components.icon', ['name' => 'chevron-right', 'size' => 'w-4 h-4'])
                    </div>
                    <ul x-show="visible" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90" @click.away="visible = false">
                        <li class="group flex items-center space-y-2">
                            <span class="mr-2 h-4 w-4"></span>
                            <a class="{{ request()->is('laporan/bulanan') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                href="{{ route('laporan-bulanan') }}">
                                Bulanan
                            </a>
                        </li>
                        <li class="group flex items-center space-y-2">
                            <span class="mr-2 h-4 w-4"></span>
                            <a class="{{ request()->is('laporan/harian') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm"
                                href="{{ route('laporan-harian') }}">
                                Harian
                            </a>
                        </li>
                    </ul>
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
                <a class="cursor-pointer flex gap-2 mt-1" href="{{ route('daftar-layanan') }}"
                    @click="selected = (selected === 'Service' ? '':'Service')" data-turbo-action="replace">
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
                <a class="cursor-pointer flex gap-2 mt-1" href="{{ route('daftar-pengguna') }}"
                    @click="selected = (selected === 'User' ? '':'User')" data-turbo-action="replace">
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
                <a class="cursor-pointer flex gap-2 mt-1" href="{{ route('daftar-satker') }}"
                    @click="selected = (selected === 'Unit' ? '':'Unit')" data-turbo-action="replace">
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
            <div class="mb-8">
                <a class="group flex cursor-pointer items-center" href="{{ route('daftar-pengguna') }}">
                    <div
                        class="{{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} mr-2 h-4 w-4">
                        @include('components.icon', ['name' => 'user-circle', 'size' => 'w-4 h-4'])
                    </div>
                    <div
                        class="{{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} text-sm font-semibold tracking-wider">
                        Atur Pengguna</div>
                </a>
            </div>
            @endrole
        </div>
    </nav>
</aside>
