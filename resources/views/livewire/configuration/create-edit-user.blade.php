@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit.prevent="submitData">
                <div class="flex flex-wrap p-6">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Pengguna Aplikasi</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Pengguna aplikasi adalah pegawai BPS yang terlibat dalam kegiatan pelayanan publik.
                        </p>
                    </div>
                    <div class="lg:w-2/3">
                        {{-- Nama Pengguna --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Nama Lengkap Pegawai',
                                'model' => 'f_nama',
                                'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_nama')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Email',
                                'model' => 'f_email',
                                'type' => 'email',
                                'label_opt' => 'Diutamakan Email BPS',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_email')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Kata Sandi --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Kata Sandi',
                                'model' => 'f_password',
                                'type' => 'password',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_password')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- NIP BPS --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'NIP BPS',
                                'model' => 'f_nip',
                                'type' => 'number',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_nip')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="flex flex-wrap p-6">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Petugas Layanan</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Petugas layanan adalah pegawai yang ditugaskan untuk melayani pengguna
                            layanan pada unit Pelayanan Statistik Terpadu (PST).
                        </p>
                    </div>
                    <div class="lg:w-2/3">
                        {{-- Petugas Layanan --}}
                        <div class="w-full p-6">
                            @include('components.input.select', [
                                'label' => 'Petugas Layanan',
                                'model' => 'f_petugas',
                                'opt_title' => 'Pilih Jenis Petugas ...',
                                'opt_item' => "<option value='0'>Bukan Petugas Layanan</option>
                                                                                                                                                                                                                                                                                        <option value='1'>Petugas Layanan</option>",
                                'value' => $routeName === 'tambah-pengguna' ? null : $pengguna->is_petugas,
                                'id' => 'petugas',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_petugas')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="w-full p-6">
                            @include('components.input.select-multiple', [
                                'label' => 'Role Petugas',
                                'model' => 'f_role',
                                'opt_item' => $this->roles,
                                'value' => $routeName === 'tambah-pengguna' ? null : $selectedRole,
                                'id' => 'role',
                            ])
                            <div x-data="{ shown: false, timeout: null }"
                                 x-init="@this.on('saved', () => {
                                     clearTimeout(timeout);
                                     shown = true;
                                     timeout = setTimeout(() => { shown = false }, 5000);
                                 })"
                                 x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_role')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        @role('superadmin')
                            {{-- Unit Kerja --}}
                            <div class="w-full p-6">
                                @include('components.input.select', [
                                    'label' => 'Unit Kerja',
                                    'model' => 'f_unit',
                                    'opt_title' => 'Pilih Unit Kerja ...',
                                    'opt_item' => $this->units,
                                    'value' =>
                                        $routeName === 'tambah-pengguna' ? null : $pengguna->kode_satker_id,
                                    'id' => 'unit',
                                ])
                                <div x-data="{ shown: false, timeout: null }"
                                     x-init="@this.on('saved', () => {
                                         clearTimeout(timeout);
                                         shown = true;
                                         timeout = setTimeout(() => { shown = false }, 5000);
                                     })"
                                     x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('f_unit')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                        @endrole
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-pengguna' ? 'Simpan' : 'Perbaharui' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
