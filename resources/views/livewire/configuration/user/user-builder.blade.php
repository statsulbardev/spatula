<div class="px-4 md:px-6 2xl:px-11 py-8">
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit="submitData">
                <div class="flex flex-wrap p-6">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Pengguna Aplikasi</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Pengguna aplikasi adalah pegawai BPS yang terlibat dalam kegiatan pelayanan publik.
                        </p>
                    </div>
                    <div class="lg:w-2/3">
                        <x-forms.inputs.text label="Nama Lengkap Pegawai" model="f_nama" type="text" />

                        <x-forms.inputs.text label="Email" model="f_email" type="email" labelopt="Diutamakan Email BPS" />

                        <x-forms.inputs.text label="Kata Sandi" model="f_password" type="password" />

                        <x-forms.inputs.text label="NIP BPS" model="f_nip" type="number" />
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
                        <x-forms.inputs.select
                            label="Petugas Layanan"
                            model="f_petugas"
                            optitem="<option value='0'>Bukan Petugas Layanan</option><option value='1'>Petugas Layanan</option>"
                            placeholder="Pilih Jenis Petugas ..."
                        />

                        {{-- @include('components.input.select-multiple', [
                        'label' => 'Role Petugas',
                        'model' => 'f_role',
                        'opt_item' => $this->roles,
                        'value' => $routeName === 'tambah-pengguna' ? null : $selectedRole,
                        'id' => 'role',
                        ]) --}}


                        @role('superadmin')
                            <x-forms.inputs.select
                                label="Unit Kerja"
                                model="f_unit"
                                :optitem="$this->units"
                                placeholder="Pilih Unit Kerja ..."
                            />
                        @endrole
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
