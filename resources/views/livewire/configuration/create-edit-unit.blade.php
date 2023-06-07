@section('title', ucwords(str_replace('-', ' ', $routeName)))

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => ucwords(str_replace('-', ' ', $routeName))])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit.prevent="submitData">
                <div class="flex flex-wrap p-6">
                    <div class="sm:w-full lg:w-1/3">
                        <h1 class="text-2xl tracking-wide">Informasi Satker</h1>
                        <p class="mt-4 text-base leading-6 lg:pr-24">
                            Informasi satker terdiri dari kode satker, nama, alamat, website, dan telepon
                            yang dapat diisi atau diubah.
                        </p>
                    </div>
                    <div class="sm:w-full lg:w-2/3">
                        {{-- Kode Satuan Kerja --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Kode',
                                'model' => 'f_kode',
                                'type' => 'number',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_kode')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Satuan Kerja --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Nama',
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

                        {{-- Level Satker --}}
                        <div class="w-full p-6">
                            @include('components.input.select', [
                                'label' => 'Level',
                                'model' => 'f_level',
                                'opt_title' => 'Pilih Level Satker ...',
                                'opt_item' => "<option value='1'>Provinsi</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value='2'>Kabupaten</option>",
                                'id' => 'level',
                                'value' => $routeName === 'tambah-satker' ? null : $this->f_level,
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_level')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat Satker --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Alamat',
                                'model' => 'f_alamat',
                                'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_alamat')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Website Satker --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Website',
                                'model' => 'f_web',
                                'type' => 'text',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_web')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="w-full p-6">
                            @include('components.input.text', [
                                'label' => 'Telepon',
                                'model' => 'f_telepon',
                                'type' => 'numeric',
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_telepon')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                    <button class="btn-primary ml-auto">
                        {{ $routeName === 'tambah-satker' ? 'Simpan' : 'Perbaharui' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
