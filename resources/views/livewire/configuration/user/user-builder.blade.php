<div>
    <x-page.page-title :title="$title" />

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
                        <x-forms.inputs.text label="Nama Lengkap Pegawai" model="form.f_nama" type="text" />

                        <x-forms.inputs.text label="Email" model="form.f_email" type="email" labelopt="Diutamakan Email BPS" />

                        <x-forms.inputs.text label="Kata Sandi" model="form.f_password" type="password" />

                        <x-forms.inputs.text label="NIP BPS" model="form.f_nip" type="number" />
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
                            model="form.f_petugas"
                            optitem="<option value='0'>Bukan Petugas Layanan</option><option value='1'>Petugas Layanan</option>"
                            placeholder="Pilih Jenis Petugas ..."
                        />

                        @role('superadmin')
                            <x-forms.inputs.select label="Unit Kerja" model="form.f_unit" :optitem="$this->units" placeholder="Pilih Unit Kerja ..." />
                        @endrole

                        <div class="mb-6 w-full">
                            <label class="form-label font-bold" for="role">Role</label>
                            <div class="form-input">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="" type="checkbox" value="admin">
                                        <label>Admin</label>
                                    </div>
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="form.f_role" type="checkbox" value="operator">
                                        <label>Operator</label>
                                    </div>
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="form.f_role" type="checkbox" value="pimpinan">
                                        <label>Pimpinan</label>
                                    </div>
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="form.f_role" type="checkbox" value="pj-layanan">
                                        <label>PJ Layanan</label>
                                    </div>
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="form.f_role" type="checkbox" value="pj-pengaduan">
                                        <label>PJ Pengaduan</label>
                                    </div>
                                    <div class="flex flex-nowrap space-x-2">
                                        <input wire:model="form.f_role" type="checkbox" valule="tim-zi">
                                        <label>Tim ZI</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
