@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <form wire:submit.prevent="submitData">
                <div class="p-6 flex flex-wrap">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Pengguna Aplikasi</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Pengguna backend aplikasi spatula adalah pegawai BPS sesuai dengan
                            role/hak akses yang telah diberikan oleh administrator. Informasi
                            pengguna dapat ditambah, diedit, atau dihapus.
                        </p>
                    </div>
                    <div class="lg:w-2/3">
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label' => 'Nama Lengkap Pegawai',
                                'model' => 'pengguna.nama',
                                'type'  => 'text'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('pengguna.nama')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label'     => 'Email',
                                'model'     => 'pengguna.email',
                                'type'      => 'email',
                                'label_opt' => 'Diutamakan Email BPS'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('pengguna.email')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label'     => 'Kata Sandi',
                                'model'     => 'pengguna.password',
                                'type'      => 'password',
                                'label_opt' => 'Setelah Login SSO, Kata Sandi Ini Akan Ditimpa Dengan Kata Sandi SSO'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('pengguna.password')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label' => 'NIP BPS',
                                'model' => 'pengguna.bpsid',
                                'type'  => 'text'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('pengguna.bpsid')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.select', [
                                'label'     => 'Unit Kerja',
                                'model'     => 'pengguna.kode_satker_id',
                                'opt_title' => 'Pilih Unit Kerja ...',
                                'opt_item'  => $units
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('pengguna.kode_satker_id')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-pengguna' ? 'Simpan' : 'Perbaharui' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
