@section('title', 'Kategorisasi')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => $customer->nama_konsumen])

    {{-- Informasi Pengguna Layanan --}}
    <section>
        <div class="h-full">
            <form wire:submit.prevent="storeData">
                <div class="w-full mx-auto bg-white border-gray-200 shadow-sm rounded-t-md">
                    <header class="pl-3 py-4 border-b border-gray-100">
                        <span class="pl-5 font-bold text-primary-500 text-lg">Informasi Pengguna Layanan</span>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td width="30%" class="pl-5 py-4 whitespace-nowrap font-semibold">Tanggal</td>
                                        <td width="1%" class="font-semibold">:</td>
                                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="pl-5 py-4 whitespace-nowrap font-semibold">Nama Pengguna Layanan</td>
                                        <td width="1%" class="font-semibold">:</td>
                                        <td>{{ $customer->nama_konsumen }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Email</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $customer->email_konsumen ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Nomor Telepon / Whatsapp</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $customer->no_wa_telepon ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Nama Petugas / Pemberi Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $customer->petugas->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Rating Petugas / Pemberi Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td>
                                            @if (!is_null($customer->rating_petugas))
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $customer->rating_petugas)
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', ['name' => 'star-solid', 'size' => 'w-5 h-5'])
                                                        </span>
                                                    @else
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', ['name' => 'star-outline', 'size' => 'w-5 h-5'])
                                                        </span>
                                                    @endif
                                                @endfor
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Jenis Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ $customer->layanan->nama_layanan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Rating Layanan</td>
                                        <td class="font-semibold">:</td>
                                        <td class="flex py-4">
                                            @if (!is_null($customer->rating_layanan))
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $customer->rating_layanan)
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', ['name' => 'star-solid', 'size' => 'w-5 h-5'])
                                                        </span>
                                                    @else
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', ['name' => 'star-outline', 'size' => 'w-5 h-5'])
                                                        </span>
                                                    @endif
                                                @endfor
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Saran/Pengaduan/Kritik/Apresiasi</td>
                                        <td class="font-semibold">:</td>
                                        <td>{{ ucwords(strtolower($customer->saran_pengaduan)) ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-5 py-4 whitespace-nowrap font-semibold">Kategori</td>
                                        <td class="font-semibold">:</td>
                                        <td class="pr-6">
                                            <div class="flex flex-wrap justify-between">
                                                <div class="flex">
                                                    <input wire:model.defer="cb_saran" type="checkbox" class="mr-2">
                                                    <label>Saran</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_pengaduan" type="checkbox" class="mr-2">
                                                    <label>Pengaduan</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_kritik" type="checkbox" class="mr-2">
                                                    <label>Kritik</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_apresiasi" type="checkbox" class="mr-2">
                                                    <label>Apresiasi</label>
                                                </div>
                                                <div class="flex">
                                                    <input wire:model.defer="cb_lainnya" type="checkbox" class="mr-2">
                                                    <label>Lainnya</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-zinc-200 border-t border-gray-200 flex items-center">
                        <button class="btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
