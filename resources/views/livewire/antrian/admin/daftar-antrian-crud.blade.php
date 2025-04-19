<div>
    {{-- Header --}}

    @if ($this->routeName == 'antrian-daftar-tambah')
        <x-page.page-title title="Tambah Antrian" />
    @elseif ($this->routeName == 'antrian-daftar-ubah')
        <x-page.page-title title="Ubah Antrian" />
    @elseif ($this->routeName == 'antrian-daftar-lihat')
        <x-page.page-title title="Lihat Antrian" />
    @endif

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <form wire:submit="submitData">
                    <div class="flex flex-wrap p-6">
                        <div class="w-full lg:w-1/3">
                            <h1 class="text-xl lg:text-2xl tracking-wide">Informasi Konsumen</h1>
                            <p class="mt-4 leading-6 lg:pr-24 text-md lg:text-base text-justify">
                                Silahkan isi informasi mengenai konsumen.
                            </p>
                        </div>
                        <div class="w-full lg:w-2/3">
                            @if ($routeName == 'antrian-daftar-tambah')
                                <p class="mt-6 form-label font-bold text-lg underline">
                                    Jika sudah pernah mendaftar silahkan cari dengan mengisi salah satu data dibawah.
                                </p>
                                <div class="mt-3 mb-6">
                                    <div>
                                        <label class="form-label font-bold" for="search_email">
                                            Cari Email Konsumen
                                        </label>
                                        <input wire:model="search_email" ref="input" type="email" placeholder="Email"
                                            class="form-input">
                                    </div>
                                </div>
                                <div class="my-6">
                                    <div>
                                        <label class="form-label font-bold" for="search_no_wa_telepon">
                                            Cari Nomor Telpon dan WA Pengguna
                                        </label>
                                        <input wire:model="search_no_wa_telepon" ref="input" type="number" placeholder="No Telpon dan WA"
                                            class="form-input">
                                    </div>
                                </div>

                                <button wire:click="search_konsumen()" type="button" class="justify-end btn-primary">Cari Konsumen</button>
                                <hr class="mt-3 -mb-3">
                            @endif

                            <div class="mt-6 mb-6">
                                <div>
                                    <label class="form-label font-bold" for="Nama Layanan">
                                        Email Konsumen
                                    </label>
                                    <input wire:model="konsumen_email" ref="input" type="email" placeholder="Email"
                                        class="form-input"
                                        {{ in_array($routeName, ["antrian-daftar-lihat", "antrian-daftar-ubah"]) ? "disabled" : "" }}>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('konsumen_email')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="konsumen_no_wa_telepon">
                                        Nomor Telpon dan WA Pengguna
                                    </label>
                                    <input wire:model="konsumen_no_wa_telepon" ref="input" type="number" placeholder="No Telpon dan WA"
                                        class="form-input"
                                        {{ in_array($routeName, ["antrian-daftar-lihat", "antrian-daftar-ubah"]) ? "disabled" : "" }}>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('konsumen_no_wa_telepon')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="konsumen_tahun_lahir">
                                        Tahun Lahir
                                    </label>
                                    <input wire:model="konsumen_tahun_lahir" ref="input" type="number" placeholder="Tahun Lahir"
                                        class="form-input"
                                        {{ in_array($routeName, ["antrian-daftar-lihat", "antrian-daftar-ubah"]) ? "disabled" : "" }}>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('konsumen_tahun_lahir')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                            <div class="my-6">
                                <div>
                                    <label class="form-label font-bold" for="konsumen_nama">
                                        Nama
                                    </label>
                                    <input wire:model="konsumen_nama" ref="input" type="text" placeholder="Nama"
                                        class="form-input"
                                        {{ in_array($routeName, ["antrian-daftar-lihat", "antrian-daftar-ubah"]) ? "disabled" : "" }}>
                                </div>
                                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                                    clearTimeout(timeout);
                                    shown = true;
                                    timeout = setTimeout(() => { shown = false }, 5000);
                                })" x-show.transition.opacity.out.duration.2000ms="shown">
                                    @error('konsumen_nama')
                                        @include('components.notification.error')
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        class="form-select"
                                        {{ in_array($routeName, ["antrian-daftar-lihat"]) ? "disabled" : "" }}>
                                        <option hidden selected>Pilih Layanan ...</option>
                                        {!!$this->layanan_satker!!}
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
                                    <input type='date' class="form-select"
                                        type="text" id="tanggal_id" wire:model="f_tanggal"
                                        placeholder="Tanggal Kunjungan"
                                        {{ in_array($routeName, ["antrian-daftar-lihat"]) ? "disabled" : "" }}/>

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
                                        class="form-select"
                                        {{ in_array($routeName, ["antrian-daftar-lihat"]) ? "disabled" : "" }}>
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
                                @if (in_array($routeName, ["antrian-daftar-tambah", "antrian-daftar-ubah"]))
                                    @include('components.input.text-area', [
                                        'model' => 'f_deskripsi',
                                        'label' => 'Deskripsi Tujuan',
                                    ])
                                @else
                                    <div class="form-textarea" disabled>
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



                @if (in_array($routeName, ["antrian-daftar-tambah", "antrian-daftar-ubah"]))
                    <div class="mt-auto flex items-center rounded-b-lg border-gray-200 bg-gray-200 p-4 shadow-sm">
                        <a href="{{route('antrian-daftar')}}" wire:navigate type="button" class="btn-secondary" >Batal</a>
                        <button type="submit" class="btn-primary ml-auto">Simpan</button>
                    </div>
                @else
                    <div class="mt-auto flex items-center rounded-b-lg border-gray-200 bg-gray-200 p-4 shadow-sm">
                        <div class="flex-grow"></div>
                        <a href="{{route('antrian-daftar')}}" wire:navigate type="button" class="btn-secondary" >Tutup</a>
                    </div>
                @endif

            </form>
        </div>
    </section>
</div>
