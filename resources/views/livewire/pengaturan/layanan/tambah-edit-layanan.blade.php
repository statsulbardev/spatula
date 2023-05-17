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
                        <h1 class="text-2xl tracking-wide">Informasi Jenis Layanan</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Informasi jenis layanan terdiri dari kode layanan dan nama layanan
                            yang dapat ditambah atau dimodifikasi.
                        </p>
                    </div>
                    <div class="pr-3 lg:w-2/3">
                        {{-- Kode Layanan --}}
                        <div class="my-6 w-full">
                            @include('components.input.text', [
                                'label' => 'Kode Layanan',
                                'model' => 'layanan.kode_layanan',
                                'type'  => 'text'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('layanan.kode_layanan')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Layanan --}}
                        <div class="my-6 w-full">
                            @include('components.input.text', [
                                'model' => 'layanan.nama_layanan',
                                'label' => 'Nama Layanan',
                                'type'  => 'text'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('layanan.nama_layanan')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Metode Layanan --}}
                        <div class="my-6 w-full">
                            @include('components.input.select', [
                                'model'     => 'layanan.metode',
                                'label'     => 'Metode Layanan',
                                'opt_title' => 'Pilih Metode Layanan ...',
                                'opt_item'  => "<option value='1'>Luring (offline)</option><option value='2'>Daring (online)</option>"
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('layanan.metode')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Deskripsi Layanan --}}
                        <div class="my-6 w-full">
                            @include('components.input.text-area', [
                                'model' => 'layanan.deskripsi',
                                'label' => 'Deskripsi Layanan'
                            ])
                            <div
                                x-data="{ shown: false, timeout: null }"
                                x-init="@this.on('saved', () => {clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false}, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('layanan.deskripsi')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-layanan' ? 'Simpan' : 'Perbaharui'}}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
