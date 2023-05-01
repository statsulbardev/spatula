@section('title', 'Form Penilaian Layanan')

@section('styles')
    <link rel="stylesheet" href="{{ secure_asset('vendor/star-rating/star-rating.min.css') }}">
@endsection

<div>
    @include('components.page.notification')

    <form wire:submit.prevent="storeData">
        <div class="bg-white border-r border-t border-l border-gray-200 shadow-sm rounded-t-lg mt-4 py-4">
            <div class="py-10 px-12 text-center">
                <h1 class="text-4xl font-extrabold tracking-wider">Selamat Datang</h1>
                <h1 class="mt-2 text-4xl font-extrabold">Saran Pengaduan Online dan Rating Petugas Layanan</h1>
                <p class="mt-5 text-lg text-zinc-500">Anda dapat memberikan penilaian terhadap petugas dan layanan yang kami diberikan.</p>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Unit Kerja</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Pilih unit kerja yang ingin anda berikan penilaian.
                    </p>
                </div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        <label class="form-label font-bold" for="Unit Kerja">
                            Unit Kerja
                        </label>
                        <select wire:model="f_unit" ref="input" class="form-select">
                            <option value="" hidden selected>Pilih Unit Kerja ...</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id . '-' . $unit->nama }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_unit')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Informasi Penerima Layanan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Silahkan isi dengan jelas dan lengkap data diri anda sebagai penerima layanan
                        statistik terpadu.
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_nama',
                            'label' => 'Nama Lengkap',
                            'type'  => 'text'
                        ])

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_nama')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_email',
                            'label' => 'Akun Email',
                            'type'  => 'email'
                        ])

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_email')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                    <div class="my-6 w-full">
                        @include('components.input.text', [
                            'model' => 'f_notelpwhatsapp',
                            'label' => 'No. Telepon / Whatsapp',
                            'type'  => 'text'
                        ])

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_notelpwhatsapp')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Penilaian Layanan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Bagaimana penilaian anda terhadap layanan yang diberikan oleh
                        <b class="text-primary-500 font-bold">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        <label class="form-label font-bold" for="Nama Layanan">
                            Nama Layanan
                        </label>
                        <select wire:model="f_layanan" ref="input" class="form-select">
                            <option value="" hidden selected>Pilih Jenis Layanan ...</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id .'-'. $service->metode }}">{{ $service->nama_layanan }}</option>
                            @endforeach
                        </select>

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_layanan')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                    @include('components.input.rating', ['model' => 'f_ratinglayanan'])

                    <div
                        x-data="{ shown: false, timeout: null }"
                        x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                        x-show.transition.opacity.out.duration.2000ms="shown">
                        @error('f_ratinglayanan')
                            @include('components.input.error')
                        @enderror
                    </div>
                </div>
            </div>

            @if (isset($f_layanan) and explode('-', $f_layanan)[1] == 1)
                <hr>
                <div class="p-6 flex flex-wrap">
                    <div class="lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Penilaian Petugas</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Bagaimana penilaian anda terhadap petugas layanan di Pelayanan Statistik Terpadu
                            <b class="text-primary-500 font-bold">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                        </p></div>
                    <div class="lg:w-2/3">
                        <div class="my-6 w-full">
                            @include('components.input.select', [
                                'model'     => 'f_petugas',
                                'label'     => 'Nama Petugas',
                                'opt_title' => 'Pilih Petugas Layanan ...',
                                'opt_item'  => $officers
                            ])

                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_petugas')
                                    @include('components.input.error')
                                @enderror
                            </div>
                        </div>
                        @include('components.input.rating', ['model' => 'f_ratingpetugas'])

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_ratingpetugas')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            <hr>
            <div class="p-6 flex flex-wrap">
                <div class="lg:w-1/3">
                    <h1 class="text-2xl tracking-wide">Kotak Saran Pengaduan</h1>
                    <p class="mt-4 leading-6 text-base lg:pr-24">
                        Berikan saran / pengaduan / kritik / apresiasi untuk layanan di
                        <b class="text-primary-500 font-bold">{{ explode('-', $f_unit)[1] ?? '...' }}</b> ?
                    </p></div>
                <div class="lg:w-2/3">
                    <div class="my-6 w-full">
                        @include('components.input.text-area', [
                            'model' => 'f_saranpengaduan',
                            'label' => 'Saran Pengaduan'
                        ])

                        <div
                            x-data="{ shown: false, timeout: null }"
                            x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 5000); })"
                            x-show.transition.opacity.out.duration.2000ms="shown">
                            @error('f_saranpengaduan')
                                @include('components.input.error')
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-auto bg-gray-200 border-gray-200 rounded-b-lg shadow-sm p-4 flex items-center">
            <button wire:click="resetData" type="button" class="btn-secondary">Batal</button>
            <button type="submit" class="btn-primary ml-auto">Simpan</button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="{{ secure_asset('vendor/star-rating/star-rating.min.js') }}"></script>
    <script>
        var starRatingControl = new StarRating('.star-rating', {
            maxStars: 5,
            showText: true,
        });

        window.addEventListener('contentChanged', event => {
            var starRatingControl = new StarRating('.star-rating', {
                maxStars: 5,
                showText: true,
            });
        });
    </script>

    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session("messages") }}'
                }));
            }
        </script>
    @endif
@endpush
