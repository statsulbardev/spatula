@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => $routeName === 'tambah-pengguna' ? 'Tambah Pengguna Baru' : 'Edit Informasi ' . $user->nama])

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <form wire:submit.prevent="storeData">
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
                                'model' => 'f_name',
                                'type'  => 'text'
                            ])
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label'     => 'Email',
                                'model'     => 'f_email',
                                'type'      => 'email',
                                'label_opt' => 'Diutamakan Email BPS'
                            ])
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label'     => 'Kata Sandi',
                                'model'     => 'f_password',
                                'type'      => 'password',
                                'label_opt' => 'Setelah Login SSO, Kata Sandi Ini Akan Ditimpa Dengan Kata Sandi SSO'
                            ])
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                                'label' => 'NIP BPS',
                                'model' => 'f_bpsid',
                                'type'  => 'text'
                            ])
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.select', [
                                'label'     => 'Unit Kerja',
                                'model'     => 'f_unit',
                                'opt_title' => 'Pilih Unit Kerja ...',
                                'opt_item'  => $units
                            ])
                        </div>
                        <div class="p-6 w-full">
                            @include('components.input.select', [
                                'label'     => 'Hak Akses Pengguna',
                                'model'     => 'f_role',
                                'opt_title' => 'Pilih Hak Akses ...',
                                'opt_item'  => $roles
                            ])
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-pengguna' ? 'Simpan' : 'Perbaharui'}}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
