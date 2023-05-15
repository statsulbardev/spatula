@section('title', 'Pengaturan Satker')

<div>
    @include('components.page.notification')

    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Daftar Satuan Kerja'])

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between">
                <div class="flex flex-no-wrap border rounded">
                    {{-- Pencarian dan Filter --}}
                    <div class="px-2 md:px-2 rounded-l border-r hover:bg-gray-100 focus:border-white focus:shadow-outline focus:z-10" x-data="{ open: false }">
                        <div class="flex py-3 items-center cursor-pointer" @click="open = true">
                            <span class="text-gray-600 text-sm hidden md:inline">FILTER</span>
                            <svg class="w-2 h-2 fill-gray-600 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                                <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
                            </svg>
                        </div>
                        <div style="position: fixed; top: 0; right: 0; left: 0; bottom: 0; z-index: 99998; background: black; opacity: .2" x-show="open"></div>
                        <div class="mt-6 -ml-6 px-4 py-6 w-screen shadow-xl bg-white rounded" style="position: absolute; z-index: 99999; max-width: 300px" x-show="open" @click.away="open = false">
                            <label class="mt-4 block text-grey-darkest">Dihapus:</label>
                            <select wire:model="trashed" class="mt-1 w-full form-select">
                                <option :value="null"></option>
                                <option value="with">Semua (Termasuk yang Dihapus)</option>
                                <option value="only">Hanya yang Terhapus</option>
                            </select>
                        </div>
                    </div>
                    <input wire:model="search" class="relative w-full px-4 rounded-r focus:shadow-outline text-sm" type="text" placeholder="Cari …" />
                </div>
                <div class="flex flex-wrap items-center">
                    {{-- Pilih Unit Kerja --}}
                    @role('admin')
                        <div class="pr-6 ml-6 border-r-2 border-zinc-200">
                            <div wire:ignore class="w-80">
                                <select wire:model="selectedUnit" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                                    <option value="null" hidden selected>Pilih Unit Kerja...</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                    @endforeach
                                </select>
                                <label data-te-select-label-ref>Unit Kerja</label>
                            </div>
                        </div>
                    @endrole

                    {{-- Tambah office --}}
                    <a
                        x-data
                        x-tooltip.raw="Tambah Satker"
                        href="{{ url(env('APP_URL') . '/pengaturan/satker/tambah') }}"
                        class="ml-6 p-3 text-white bg-primary-400 hover:bg-primary-500 rounded-md">
                        @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-6 h-6'])
                    </a>
                </div>
            </div>
            @if($offices->count() === 0)
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pt-6 pb-4">Kode Satker</th>
                            <th class="px-6 pt-6 pb-4">Nama Satker</th>
                            <th class="px-6 pt-6 pb-4">Alamat</th>
                            <th class="px-6 pt-6 pb-4">Web</th>
                            <th class="px-6 pt-6 pb-4">Telepon</th>
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices->paginate(20) as $office)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $office->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $office->kode_satker }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $office->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $office->alamat }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $office->web }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $office->telepon }}
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2">
                                        <a
                                            x-data
                                            x-tooltip.raw="Edit Satker"
                                            href="{{ url(env('APP_URL') . '/pengaturan/satker/' . $office->id . '/edit') }}"
                                            class="text-violet-500 hover:text-violet-600 cursor-pointer">
                                            @include('components.icon', ['name' => 'pencil-square', 'size' => 'w-5 h-5'])
                                        </a>
                                        <button
                                            x-data
                                            x-tooltip.raw="Hapus Pengguna"
                                            class="text-red-500 hover:text-red-600">
                                            @include('components.icon', ['name' => 'trash', 'size' => 'w-5 h-5'])
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
    {{ $offices->paginate(20)->links('vendor.spatula') }}
</div>
