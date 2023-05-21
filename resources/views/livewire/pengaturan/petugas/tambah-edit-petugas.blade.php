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
                        <h1 class="text-2xl tracking-wide">Informasi Petugas Layanan</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Pengguna aplikasi dapat didaftarkan sebagai petugas layanan.
                            Petugas layanan terdiri dari PJ Layanan, PJ Pengaduan, dan Operator
                        </p>
                    </div>
                    <div class="lg:w-2/3">
                        <div class="p-6 w-full">
                            @include('components.input.select', [
                                'label'     => 'Daftar Pegawai',
                                'model'     => 'f_petugas',
                                'opt_title' => 'Pilih Pegawai ...',
                                'opt_item'  => $officers,
                                'value'     => $routeName === 'tambah-petugas' ? null : $petugas->id,
                                'prop'      => $routeName === 'tambah-petugas' ?: 'disabled',
                                'id'        => 'petugas'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_petugas')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.select-multiple', [
                                'label'    => 'Role Petugas',
                                'model'    => 'f_role',
                                'opt_item' => $roles,
                                'value'    => $routeName === 'tambah-petugas' ? null : $selectedRole,
                                'id'       => 'role'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_role')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-petugas' ? 'Simpan' : 'Perbaharui' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
