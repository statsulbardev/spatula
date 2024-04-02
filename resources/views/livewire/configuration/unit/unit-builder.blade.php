<div class="px-4 md:px-6 2xl:px-11 py-8">
   <x-page.page-title :title="$pageTitle" />

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit="submitData">
                <div class="flex flex-wrap p-6">
                    <div class="sm:w-full lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Satker</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Informasi satker terdiri dari kode satker, nama, alamat, website, dan telepon
                            yang dapat diisi atau diubah.
                        </p>
                    </div>
                    <div class="sm:w-full lg:w-2/3">
                        <x-forms.inputs.text label="Kode" model="form.f_kode" type="number" />

                        <x-forms.inputs.text label="Nama Satker" model="form.f_nama" type="text" />

                        <x-forms.inputs.select
                            label="Level"
                            model="form.f_level"
                            placeholder="Pilih Level Satker ..."
                            optitem="<option value='1'>Provinsi</option><option value='2'>Kabupaten</option>"
                        />

                        <x-forms.inputs.text label="Alamat" model="form.f_alamat" type="text" />

                        <x-forms.inputs.text label="Website" model="form.f_web" type="text" />

                        <x-forms.inputs.text label="Telepon" model="form.f_telepon" type="numeric" />
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
