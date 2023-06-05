@section('title', 'Kategorisasi')

<div>

    @include('components.page.page-title', [
        'title' => 'Verifikasi Penilaian Layanan Dari ' . $pengguna_layanan->nama_konsumen,
    ])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    {{-- Informasi Pengguna Layanan --}}
    <section>
        <div class="h-full">
            <form wire:submit.prevent="submitData">
                <div class="mx-auto w-full rounded-t-md border-gray-200 bg-white shadow-sm">
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <tbody class="divide-y divide-gray-100">
                                    {{-- Tanggal --}}
                                    <tr>
                                        <td width="30%"
                                            class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal</td>
                                        <td width="1%"
                                            class="font-semibold">:</td>
                                        <td>{{ $pengguna_layanan->created_at->format('d/m/Y') }}</td>
                                    </tr>

                                    {{-- Nama Pengguna Layanan --}}
                                    <tr>
                                        <td width="30%"
                                            class="whitespace-nowrap py-6 pl-5 font-semibold">Nama
                                            Pengguna Layanan</td>
                                        <td width="1%"
                                            class="font-semibold">:</td>
                                        <td>{{ $pengguna_layanan->nama_konsumen }}</td>
                                    </tr>

                                    {{-- Email Pengguna Layanan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Email</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $pengguna_layanan->email_konsumen ?? '-' }}</td>
                                    </tr>

                                    {{-- No. WA/Telepon Pengguna Layanan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nomor Telepon / Whatsapp
                                        </td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $pengguna_layanan->no_wa_telepon ?? '-' }}</td>
                                    </tr>

                                    {{-- Jenis Layanan yang Diterima --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Jenis Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td class="flex flex-nowrap items-center py-6"
                                            x-data="{ open: true }">
                                            <select wire:model.defer="f_layanan"
                                                    ref="input"
                                                    class="form-select"
                                                    :disabled="open">
                                                <option hidden
                                                        selected>Pilih Jenis Layanan ...</option>
                                                @foreach ($this->services as $service)
                                                    <option value="{{ $service['kode_layanan'] }}">
                                                        {{ $service['nama_layanan'] }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button"
                                                    x-data
                                                    x-tooltip.raw="Edit Layanan"
                                                    @click="open = !open"
                                                    class="mx-5 cursor-pointer text-red-500 hover:text-red-600">
                                                @include('components.icon', [
                                                    'name' => 'pencil-square',
                                                    'size' => 'w-5 h-5',
                                                ])
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Rating Layanan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td class="flex flex-nowrap items-center py-6">
                                            <div class="mr-6 flex">
                                                @if (!is_null($pengguna_layanan->rating_layanan))
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $pengguna_layanan->rating_layanan)
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                @include('components.icon', [
                                                                    'name' => 'star-solid',
                                                                    'size' => 'w-5 h-5',
                                                                ])
                                                            </span>
                                                        @else
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                @include('components.icon', [
                                                                    'name' => 'star-outline',
                                                                    'size' => 'w-5 h-5',
                                                                ])
                                                            </span>
                                                        @endif
                                                    @endfor
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="flex w-full flex-nowrap items-center"
                                                 x-data="{ open: true }">
                                                <select wire:model.defer="f_rating_layanan"
                                                        ref="input"
                                                        class="form-select"
                                                        :disabled="open">
                                                    <option hidden
                                                            selected>Pilih Rating Layanan ...</option>
                                                    <option value="1">Sangat Tidak Puas</option>
                                                    <option value="2">Tidak Puas</option>
                                                    <option value="3">Cukup Puas</option>
                                                    <option value="4">Puas</option>
                                                    <option value="5">Sangat Puas</option>
                                                </select>
                                                <button type="button"
                                                        x-data
                                                        x-tooltip.raw="Edit Rating"
                                                        @click="open = !open"
                                                        class="mx-5 cursor-pointer text-red-500 hover:text-red-600">
                                                    @include('components.icon', [
                                                        'name' => 'pencil-square',
                                                        'size' => 'w-5 h-5',
                                                    ])
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Nama Petugas Layanan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nama Petugas / Pemberi
                                            Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td class="flex flex-nowrap items-center py-6"
                                            x-data="{ open: true }">
                                            <select wire:model.defer="f_petugas"
                                                    ref="input"
                                                    class="form-select"
                                                    :disabled="open">
                                                <option hidden
                                                        selected>Pilih Petugas Layanan ...</option>
                                                @foreach ($this->officers as $officer)
                                                    <option value="{{ $officer['id'] }}">{{ $officer['nama'] }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button"
                                                    x-data
                                                    x-tooltip.raw="Edit Petugas"
                                                    @click="open = !open"
                                                    class="mx-5 cursor-pointer text-red-500 hover:text-red-600">
                                                @include('components.icon', [
                                                    'name' => 'pencil-square',
                                                    'size' => 'w-5 h-5',
                                                ])
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Rating Petugas Layanan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Petugas / Pemberi
                                            Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td class="flex flex-nowrap items-center py-6">
                                            <div class="mr-6 flex">
                                                @if (!is_null($pengguna_layanan->rating_petugas))
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $pengguna_layanan->rating_petugas)
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                @include('components.icon', [
                                                                    'name' => 'star-solid',
                                                                    'size' => 'w-5 h-5',
                                                                ])
                                                            </span>
                                                        @else
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                @include('components.icon', [
                                                                    'name' => 'star-outline',
                                                                    'size' => 'w-5 h-5',
                                                                ])
                                                            </span>
                                                        @endif
                                                    @endfor
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="flex w-full flex-nowrap items-center"
                                                 x-data="{ open: true }">
                                                <select wire:model.defer="f_rating_petugas"
                                                        ref="input"
                                                        class="form-select"
                                                        :disabled="open">
                                                    <option hidden
                                                            selected>Pilih Rating Petugas ...</option>
                                                    <option value="1">Sangat Tidak Puas</option>
                                                    <option value="2">Tidak Puas</option>
                                                    <option value="3">Cukup Puas</option>
                                                    <option value="4">Puas</option>
                                                    <option value="5">Sangat Puas</option>
                                                </select>
                                                <button type="button"
                                                        x-data
                                                        x-tooltip.raw="Edit Rating"
                                                        @click="open = !open"
                                                        class="mx-5 cursor-pointer text-red-500 hover:text-red-600">
                                                    @include('components.icon', [
                                                        'name' => 'pencil-square',
                                                        'size' => 'w-5 h-5',
                                                    ])
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Saran Pengaduan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Saran / Pengaduan / Kritik
                                            / Apresiasi</td>
                                        <td class="font-semibold">:</td>
                                        <td>{!! ucwords(strtolower($pengguna_layanan->saran_pengaduan)) ?? '-' !!}</td>
                                    </tr>

                                    {{-- Kategorisasi --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Kategori</td>
                                        <td class="font-semibold">:</td>
                                        <td class="pr-6">
                                            <div class="flex flex-wrap justify-between">
                                                <div class="flex">
                                                    <input wire:model.defer="cb_saran"
                                                           type="checkbox"
                                                           class="mr-2">
                                                    <label>Saran</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_pengaduan"
                                                           type="checkbox"
                                                           class="mr-2">
                                                    <label>Pengaduan</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_kritik"
                                                           type="checkbox"
                                                           class="mr-2">
                                                    <label>Kritik</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_apresiasi"
                                                           type="checkbox"
                                                           class="mr-2">
                                                    <label>Apresiasi</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_lainnya"
                                                           type="checkbox"
                                                           class="mr-2">
                                                    <label>Lainnya</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Catatan --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Catatan</td>
                                        <td class="font-semibold">:</td>
                                        <td><input wire:model.defer="f_catatan"
                                                   type="text"
                                                   ref="input"
                                                   class="form-input"
                                                   placeholder="Contoh : Nama Kegiatan ..."></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center border-t border-gray-200 bg-zinc-200 px-8 py-4">
                        <button class="btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
