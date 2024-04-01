@section('title', 'Daftar Layanan Antrian')

<div class="w-full lg:w-3/4 px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @if ($this->routeName == 'antrian-non-admin-item-tambah')
            @include('components.page.page-title', ['title' => 'Tambah Antrian'])
        @elseif ($this->routeName == 'antrian-non-admin-item-edit')
            @include('components.page.page-title', ['title' => 'Edit Antrian'])
        @elseif ($this->routeName == 'antrian-non-admin-item-lihat')
            @include('components.page.page-title', ['title' => 'Ubah Antrian'])
        @endif
        
        {{-- Antrian Baru --}}
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')
    <div>
        <form wire:submit.prevent="submitData">
            <div class="mt-4 rounded-t-lg border-l border-r border-t border-gray-200 bg-white py-4 shadow-sm">
                {{-- Unit Kerja --}}
                <div class="flex flex-wrap p-6">
                    <div class="w-full lg:w-1/3">
                        <h1 class="text-xl lg:text-2xl tracking-wide">Unit Kerja</h1>
                        <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                            Pilih unit kerja yang ingin dikunjungi.
                        </p>
                    </div>
                    <div class="w-full lg:w-2/3">
                        <div class="my-6">
                            {{-- Unit Kerja yang Dinilai --}}
                            @include('components.input.select-realtime', [
                                'label' => 'Unit Kerja',
                                'model' => 'f_kode_satker',
                                'opt_title' => 'Pilih Unit Kerja ...',
                                'opt_item' => $this->units,
                                'value' => $this->f_kode_satker,
                                'id' => 'unit_kerja',
                                'prop' => in_array($routeName, ["antrian-non-admin-item-lihat", "antrian-non-admin-item-edit"]) ? "disabled" : "",
                            ])
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                clearTimeout(timeout);
                                shown = true;
                                timeout = setTimeout(() => { shown = false }, 5000);
                            })" x-show.transition.opacity.out.duration.2000ms="shown">
                                @error('f_kode_satker')
                                    @include('components.notification.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Pengguna Layanan --}}
                @if ($this->f_kode_satker)
                    <hr>
                    <div class="flex flex-wrap p-6">
                        <div class="w-full lg:w-1/3">
                            <h1 class="text-xl lg:text-2xl tracking-wide">Informasi Layanan</h1>
                            <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                                Silahkan isi informasi layanan yang dituju.
                            </p>
                        </div>
                        <div class="w-full lg:w-2/3">
                            {{-- Nama Layanan --}}
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="Nama Layanan">
                                        Nama Layanan
                                    </label>
                                    <select id="layanan_id" wire:model="f_kode_layanan" 
                                        class="border border-1 w-full p-2 rounded-md border-slate-400 disabled:bg-gray-200 disabled:text-slate-900"
                                        {{ in_array($routeName, ["antrian-non-admin-item-lihat", "antrian-non-admin-item-edit"]) ? "disabled" : "" }}>
                                        <option hidden selected>Pilih Layanan ...</option>
                                        {!!$layanan_satker!!}
                                    </select>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('f_kode_layanan')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                            {{-- Tanggal --}}
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="Tanggal Kunjungan">
                                    Tanggal Kunjungan
                                    </label>
                                    <input type='date' class="border border-1 w-full p-2 rounded-md border-slate-400 disabled:bg-gray-200 disabled:text-slate-900"
                                        type="text" id="tanggal_id" wire:model="f_tanggal"
                                        placeholder="Tanggal Kunjungan" 
                                        {{ in_array($routeName, ["antrian-non-admin-item-lihat"]) ? "disabled" : "" }}/>

                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('f_tanggal')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="Nama Layanan">
                                        Periode Kedatangan
                                    </label>
                                    <select id="periode_id" wire:model="f_periode" 
                                        class="border border-1 w-full p-2 rounded-md border-slate-400 disabled:bg-gray-200 disabled:text-slate-900" 
                                        {{ in_array($routeName, ["antrian-non-admin-item-lihat"]) ? "disabled" : "" }}>
                                        <option hidden selected>Pilih Periode ...</option>
                                        <option value="0">Jam Pertama (Sebelum Istirahat)</option>
                                        <option value="1">Jam Kedua (Setelah Istirahat)</option>
                                    </select>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('f_periode')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Saran Pengaduan --}}
                    <hr>
                    <div wire:key="saran_pengaduan" class="flex flex-wrap p-6">
                        <div class="lg:w-1/3">
                            <h1 class="text-xl lg:text-2xl tracking-wide">Tujuan Kunjungan</h1>
                            <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                                Isikan deskrpsi tujuan kunjungan ?
                            </p>
                        </div>
                        <div class="w-full lg:w-2/3">
                            <div class="my-6">
                                @if (in_array($routeName, ["antrian-non-admin-item-tambah", "antrian-non-admin-item-edit"]))
                                    @include('components.input.text-area', [
                                        'model' => 'f_deskripsi',
                                        'label' => 'Deskripsi Tujuan',
                                    ])
                                @else
                                    <div class="border border-1 w-full h-full p-4 rounded-md border-slate-400 bg-gray-200">
                                        {!!$this->f_deskripsi!!}
                                    </div>
                                @endif
                               

                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('f_deskripsi')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
              
            </div>
            
            @if (in_array($routeName, ["antrian-non-admin-item-tambah", "antrian-non-admin-item-edit"]))
                <div class="mt-auto flex items-center rounded-b-lg border-gray-200 bg-gray-200 p-4 shadow-sm">
                    <a href="{{route('antrian-non-admin-lihat')}}" wire:navigate type="button" class="btn-secondary" >Batal</a>
                        @if ($this->f_kode_satker)
                            <button type="submit" class="btn-primary ml-auto">Simpan</button>
                        @endif
                </div>
            @else
                <div class="mt-auto flex items-center rounded-b-lg border-gray-200 bg-gray-200 p-4 shadow-sm">
                    <div class="flex-grow"></div>
                    <a href="{{route('antrian-non-admin-lihat')}}" wire:navigate type="button" class="btn-secondary" >Tutup</a>
                </div>
            @endif
            
        </form>
    </div>
    
    {{-- Content --}}
</div>

