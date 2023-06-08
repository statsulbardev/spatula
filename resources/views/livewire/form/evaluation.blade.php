@section('title', 'Form Penilaian Layanan')

<div>
    @include('components.notification.flash')

    <form wire:submit.prevent="submitData">
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
                    <div class="my-6">
                        {{-- Unit Kerja yang Dinilai --}}
                        @include('components.input.select-realtime', [
                            'label' => 'Unit Kerja',
                            'model' => 'f_unit',
                            'opt_title' => 'Pilih Unit Kerja ...',
                            'opt_item' => $this->units,
                            'value' => null,
                            'id' => 'unit_kerja',
                        ])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_unit')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
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
                    {{-- Nama Konsumen --}}
                    <div class="my-6">
                        @include('components.input.text', [
                            'label' => 'Nama Lengkap',
                            'model' => 'f_nama',
                            'type' => 'text',
                        ])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_nama')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="my-6">
                        @include('components.input.text', [
                            'label' => 'Akun Email',
                            'model' => 'f_email',
                            'type' => 'email',
                        ])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_email')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
                    {{-- No. WA / Telepon --}}
                    <div class="my-6">
                        @include('components.input.text', [
                            'label' => 'No. Telepon / Whatsapp',
                            'model' => 'f_nowatelp',
                            'type' => 'numeric',
                        ])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_nowatelp')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Penilaian Layanan --}}
            <hr>
            <div class="flex flex-wrap p-6">
                <div class="w-full lg:w-1/3">
                    <h1 class="text-xl lg:text-2xl tracking-wide">Penilaian Layanan</h1>
                    <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                        Bagaimana penilaian anda terhadap layanan yang diberikan oleh
                        <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                    </p>
                </div>
                <div class="w-full lg:w-2/3">
                    {{-- Nama Layanan --}}
                    <div class="my-6">
                        @include('components.input.select-realtime', [
                            'label' => 'Nama Layanan',
                            'model' => 'f_layanan',
                            'opt_title' => 'Pilih Jenis Layanan ...',
                            'opt_item' => $this->services,
                            'value' => null,
                            'id' => 'jenis_layanan',
                        ])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_layanan')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>

                    {{-- Rating Layanan --}}
                    @include('components.input.rating', ['model' => 'f_ratinglayanan'])
                    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                        clearTimeout(timeout);
                        shown = true;
                        timeout = setTimeout(() => { shown = false }, 5000);
                    })" x-show.transition.opacity.out.duration.2000ms="shown">
                        @error('f_ratinglayanan')
                            @include('components.notification.error')
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Petugas Layanan --}}
            @if (isset($f_layanan) and explode('-', $f_layanan)[1] == 1)
                <hr>
                <div wire:key="petugas_layanan" class="flex flex-wrap p-6">
                    <div class="w-full lg:w-1/3">
                        <h1 class="text-xl lg:text-2xl tracking-wide">Penilaian Petugas</h1>
                        <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                            Bagaimana penilaian anda terhadap petugas layanan di Pelayanan Statistik Terpadu
                            <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                        </p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        {{-- Petugas Layanan --}}
                        <div class="my-6">
                            @include('components.input.select', [
                                'label' => 'Nama Petugas',
                                'model' => 'f_petugas',
                                'opt_title' => 'Pilih Petugas Layanan ...',
                                'opt_item' => $officers,
                                'id' => 'petugas',
                                'value' => null,
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_petugas')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Rating Petugas --}}
                        @include('components.input.rating', ['model' => 'f_ratingpetugas'])
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_ratingpetugas')
                                @include('components.notification.error')
                            @enderror
                        </div>
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
                        <b class="font-bold text-primary-500">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                    </p>
                </div>
                <div class="w-full lg:w-2/3">
                    <div class="my-6">
                        @include('components.input.text-area', [
                            'model' => 'f_saranpengaduan',
                            'label' => 'Saran Pengaduan',
                        ])

                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                            clearTimeout(timeout);
                            shown = true;
                            timeout = setTimeout(() => { shown = false }, 5000);
                        })" x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_saranpengaduan')
                                @include('components.notification.error')
                            @enderror
                        </div>
                    </div>
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
                    <p>Terima kasih atas penilaian yang anda berikan ...</p>
                </div>

                <!--Modal footer-->
                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md p-4">
                    <button type="button"
                        class="text-primary-700 hover:bg-primary-accent-100 focus:bg-primary-accent-100 active:bg-primary-accent-200 inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0"
                        data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var starRatingControl = new StarRating('.star-rating', {
            maxStars: 5,
            showText: true,
        });

        window.addEventListener('contentChanged', event => {
            te.Select.getOrCreateInstance(document.querySelector('#petugas')).close();

            var starRatingControl = new StarRating('.star-rating', {
                maxStars: 5,
                showText: true,
            });
        });

        window.addEventListener('notification', event => {
            document.getElementById('notification_button').click();
        });
    </script>
@endpush
