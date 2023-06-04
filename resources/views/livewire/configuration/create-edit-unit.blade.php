@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <form wire:submit.prevent="submitData">
                <div class="p-6 flex flex-wrap">
                    <div class="lg:w-1/3 sm:w-full">
                        <h1 class="text-2xl tracking-wide">Informasi Satker</h1>
                        <p class="mt-4 leading-6 text-base lg:pr-24">
                            Informasi satker terdiri dari kode satker, nama, alamat, website, dan telepon
                            yang dapat diisi atau diubah.
                        </p>
                    </div>
                    <div class="lg:w-2/3 sm:w-full">
                        {{-- Kode Satuan Kerja --}}
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                            'label' => 'Kode',
                            'model' => 'f_kode',
                            'type' => 'number',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_kode')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Satuan Kerja --}}
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                            'label' => 'Nama',
                            'model' => 'f_nama',
                            'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_nama')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Level Satker --}}
                        <div class="p-6 w-full">
                            @include('components.input.select', [
                            'label' => 'Level',
                            'model' => 'f_level',
                            'opt_title' => 'Pilih Level Satker ...',
                            'opt_item' =>
                            "<option value='1'>Provinsi</option>
                            <option value='2'>Kabupaten</option>",
                            'id' => 'level',
                            'value' => $routeName === 'tambah-satker' ? null : $this->f_level,
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_level')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat Satker --}}
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                            'label' => 'Alamat',
                            'model' => 'f_alamat',
                            'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_alamat')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Website Satker --}}
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                            'label' => 'Website',
                            'model' => 'f_web',
                            'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_web')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="p-6 w-full">
                            @include('components.input.text', [
                            'label' => 'Telepon',
                            'model' => 'f_telepon',
                            'type' => 'numeric',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000); })"
                                x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_telepon')
                                @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-satker' ? 'Simpan' : 'Perbaharui' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>