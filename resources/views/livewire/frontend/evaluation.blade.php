<div>
    <form wire:submit="submitData">
        <div class="text-xs text-right mt-3">
            <span class="font-medium">Admin Spatula, </span>
            <a href="{{ route('login') }}" target="_blank" class="font-medium text-primary-400 hover:text-primary-500">Login
                Disini</a>
        </div>
        <div class="mt-4 rounded-t-lg border-l border-r border-t border-gray-200 bg-white py-4 shadow-sm">
            {{-- Header --}}
            <div class="px-12 py-10 text-center">
                <h1 class="font-extrabold tracking-wider text-xl lg:text-4xl">Selamat Datang</h1>
                <h1 class="mt-2 font-extrabold text-xl lg:text-4xl">Saran Pengaduan Online dan Rating Petugas Layanan
                </h1>
                <p class="mt-5 text-zinc-500 text-sm lg:text-lg">Anda dapat memberikan penilaian terhadap petugas dan
                    layanan yang kami diberikan.</p>
            </div>

            {{-- Unit Kerja --}}
            <hr>
            <div class="flex flex-wrap p-6">
                <div class="w-full lg:w-1/3">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Unit Kerja</h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                        Pilih unit kerja yang ingin anda berikan penilaian.
                    </p>
                </div>
                <div class="w-full lg:w-2/3">
                    <x-forms.inputs.select label="Unit Kerja" model="f_unit" method="live" :optitem="$this->units"
                        placeholder="Pilih Unit Kerja ..." />
                </div>
            </div>

            {{-- Informasi Pengguna Layanan --}}
            <hr>
            <div class="flex flex-wrap p-6">
                <div class="w-full lg:w-1/3">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Informasi Penerima Layanan</h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                        Silahkan isi dengan jelas dan lengkap data diri anda sebagai penerima layanan
                        statistik terpadu.
                    </p>
                </div>
                <div class="w-full lg:w-2/3">
                    <x-forms.inputs.text label="Nama Lengkap" model="f_nama" type="text" />

                    <x-forms.inputs.text label="Akun Email" model="f_email" type="email" />

                    <x-forms.inputs.text label="No. Telepon / Whatsapp" model="f_nowatelp" type="numeric" />
                </div>
            </div>

            {{-- Penilaian Layanan --}}
            @if (isset($f_unit))
                <hr>
                <div class="flex flex-wrap p-6">
                    <div class="w-full lg:w-1/3">
                        <h1 class="text-xl lg:text-2xl tracking-wide">Penilaian Layanan</h1>
                        <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                            Bagaimana penilaian anda terhadap layanan yang diberikan oleh
                            <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[2] ?? '...' }}</b> ?
                        </p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <x-forms.inputs.select label="Nama Layanan" model="f_layanan" method="live" :optitem="$this->unitServices"
                            placeholder="Pilih Jenis Layanan ..." />

                        <x-forms.inputs.rating id="ratinglayanan_id" model="f_ratinglayanan" />
                    </div>
                </div>
            @endif

            {{-- Petugas Layanan --}}
            @if (isset($f_layanan) and explode('-', $f_layanan)[1] == 1)
                <hr>
                <div wire:key="petugas_layanan" class="flex flex-wrap p-6" x-init="$nextTick(() => { $dispatch('contentChanged') })">
                    <div class="w-full lg:w-1/3">
                        <h1 class="text-xl lg:text-2xl tracking-wide">Penilaian Petugas</h1>
                        <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                            Bagaimana penilaian anda terhadap petugas layanan di Pelayanan Statistik Terpadu
                            <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[2] ?? '...' }}</b> ?
                        </p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <x-forms.inputs.select label="Nama Petugas" model="f_petugas" method="live" :optitem="$officers"
                            placeholder="Pilih Petugas Layanan ..." />

                        <x-forms.inputs.rating id="ratingpetugas" model="f_ratingpetugas" />
                    </div>
                </div>
            @endif

            {{-- Saran Pengaduan --}}
            <hr>
            <div wire:key="saran_pengaduan" class="flex flex-wrap p-6">
                <div class="lg:w-1/3">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Kotak Saran Pengaduan</h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                        Berikan saran / pengaduan / kritik / apresiasi untuk layanan di
                        <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[2] ?? '...' }}</b> ?
                    </p>
                </div>
                <div class="w-full lg:w-2/3">
                    <x-forms.inputs.text-area model="f_saranpengaduan" label="Saran Pengaduan" />
                </div>
            </div>
        </div>
        <div class="mt-auto flex items-center rounded-b-lg border-gray-200 bg-gray-200 p-4 shadow-sm">
            <button wire:click="resetData" type="button" class="btn-secondary">Batal</button>
            <button type="submit" class="btn-primary ml-auto">Simpan</button>
        </div>
    </form>

    {{-- Tailwind Element Modal --}}
    <button id="notification_button" data-te-toggle="modal" data-te-target="#saveModal" data-te-ripple-init data-te-ripple-color="light"
        hidden></button>
    <div wire:ignore data-te-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="saveModal"
        tabindex="-1" aria-labelledby="saveModalTitle" aria-modal="true" role="dialog">
        <div data-te-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
                class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
                <div
                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5 class="text-primary text-xl font-medium leading-normal" id="exampleModalScrollableLabel">
                        Notifikasi</h5>
                    <!--Close button-->
                    <button type="button"
                        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                        data-te-modal-dismiss aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!--Modal body-->
                <div class="relative p-4">
                    <p>Terima kasih telah melakukan penilaian terhadap layanan kami</p>
                </div>

                <!--Modal footer-->
                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md p-4">
                    <button type="button"
                        class="text-white bg-primary-400 hover:bg-primary-500 focus:bg-primary-accent-100 active:bg-primary-accent-200 inline-block rounded  px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0"
                        data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('notification_evaluasi', () => {
            document.getElementById('notification_button').click();
        })
    </script>
@endscript
