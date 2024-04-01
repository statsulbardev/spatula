<div class="px-4 md:px-6 2xl:px-11 py-8">
    <x-page.page-title :title="$pageTitle" />

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit="submitData">
                <div class="flex flex-wrap p-6">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Jenis Layanan</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Informasi jenis layanan terdiri dari kode layanan dan nama layanan
                            yang dapat ditambah atau dimodifikasi.
                        </p>
                    </div>
                    <div class="pr-3 lg:w-2/3">
                        <x-forms.inputs.text label="Kode Layanan" model="form.f_kode" type="text" />

                        <x-forms.inputs.text label="Nama Layanan" model="form.f_nama" type="text" />

                        <x-forms.inputs.select
                            label="Metode Layanan"
                            model="form.f_metode"
                            optitem="<option value='1'>Luring (offline)</option><option value='2'>Daring (online)</option>"
                            placeholder="Pilih Metode Layanan ..."
                        />

                        <x-forms.inputs.text-area model="form.f_deskripsi" label="Deskripsi Layanan" />
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
