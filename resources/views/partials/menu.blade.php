{{-- Dashbboard --}}
<div class="mb-8">
    <a class="flex items-center group cursor-pointer" href="{{ route('dashboard') }}">
        <div class="w-4 h-4 mr-2 {{ request()->is('dashboard') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}">
            @include('components.icon', ['name' => 'home', 'size' => 'w-4 h-4'])
        </div>
        <div class="text-sm {{ request()->is('dashboard') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}">Dashboard</div>
    </a>
</div>

{{-- Verifikasi --}}
<div class="mb-8 cursor-pointer" x-data="{ visible: false }">
    <div class="flex items-center group pb-1" @click="visible = true">
        <div class="{{ request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4 mr-2">
            @include('components.icon', ['name' => 'rectangle-stack', 'size' => 'w-4 h-4'])
        </div>
        <div class="text-sm {{ request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-7/12">Verifikasi</div>
        <div class="{{ request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="!visible">
            @include('components.icon', ['name' => 'chevron-right', 'size' => 'w-4 h-4'])
        </div>
        <div class="{{ request()->is('verifikasi/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="visible">
            @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-4 h-4'])
        </div>
    </div>
    <ul x-show="visible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        @click.away="visible = false">
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{ request()->is('verifikasi/selesai') || request()->is('verifikasi/selesai/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}" href="{{ route('daftar-selesai') }}">
                Selesai
            </a>
        </li>
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{ request()->is('verifikasi/pj-layanan') || request()->is('verifikasi/pj-layanan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}" href="{{ route('daftar-pj-layanan') }}">
                PJ Layanan
            </a>
        </li>
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{ request()->is('verifikasi/pj-pengaduan') || request()->is('verifikasi/pj-pengaduan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}" href="{{ route('daftar-pj-pengaduan') }}">
                PJ Pengaduan
            </a>
        </li>
    </ul>
</div>

{{-- Laporan --}}
<div class="mb-8 cursor-pointer" x-data="{ visible: false }">
    <div class="flex items-center group pb-1" @click="visible = true">
        <div class="{{ request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4 mr-2">
            @include('components.icon', ['name' => 'presentation-chart', 'size' => 'w-4 h-4'])
        </div>
        <div class="text-sm {{ request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-7/12">
            Laporan
        </div>
        <div class="{{ request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="!visible">
            @include('components.icon', ['name' => 'chevron-right', 'size' => 'w-4 h-4'])
        </div>
        <div class="{{ request()->is('laporan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="visible">
            @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-4 h-4'])
        </div>
    </div>
    <ul x-show="visible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        @click.away="visible = false">
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{ request()->is('laporan/bulanan') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}" href="{{ route('laporan-bulanan') }}">
                Bulanan
            </a>
        </li>
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{ request()->is('laporan/harian') ? 'text-white' : 'text-primary-100 group-hover:text-white' }}" href="{{ route('laporan-harian') }}">
                Harian
            </a>
        </li>
    </ul>
</div>

{{-- Konfigurasi --}}
<div class="mb-6 cursor-pointer" x-data="{ visible: false }">
    <div class="flex items-center group pb-1" @click="visible = true">
        <div class="{{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4 mr-2">
            @include('components.icon', ['name' => 'cog', 'size' => 'w-4 h-4'])
        </div>
        <div class="text-sm {{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-7/12">
            Pengaturan
        </div>
        <div class="{{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="!visible">
            @include('components.icon', ['name' => 'chevron-right', 'size' => 'w-4 h-4'])
        </div>
        <div class="{{ request()->is('pengaturan/*') ? 'text-white' : 'text-primary-100 group-hover:text-white' }} w-4 h-4" x-show="visible">
            @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-4 h-4'])
        </div>
    </div>
    <ul x-show="visible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        @click.away="visible = false">
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{
                request()->is('pengaturan/layanan') || request()->is('pengaturan/layanan/*') ?
                'text-white' : 'text-primary-100 group-hover:text-white' }}"
                href="{{ route('daftar-layanan') }}">
                Layanan
            </a>
        </li>
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{
                request()->is('pengaturan/pengguna') || request()->is('pengaturan/pengguna/*') ?
                'text-white' : 'text-primary-100 group-hover:text-white' }}"
                href="{{ route('daftar-pengguna') }}">
                Pengguna
            </a>
        </li>
        <li class="flex items-center group space-y-2">
            <span class="w-4 h-4 mr-2"></span>
            <a class="text-sm {{
                request()->is('pengaturan/satker') || request()->is('pengaturan/satker/*') ?
                'text-white' : 'text-primary-100 group-hover:text-white' }}"
                href="{{ route('daftar-satker') }}">
                Satuan Kerja
            </a>
        </li>
    </ul>
</div>


