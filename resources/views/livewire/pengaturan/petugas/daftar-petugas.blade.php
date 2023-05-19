@section('title', 'Pengaturan Petugas')

<div>
    <div class="mb-8">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Petugas Layanan'])
    </div>

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between">
                {{-- Pencarian --}}
                @include('components.input.search')

                <div class="flex flex-wrap">
                    {{-- <div wire:ignore class="w-80">
                        <select wire:model="selectedUnit" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                            <option value="null" hidden selected>Pilih Unit Kerja...</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Unit Kerja</label>
                    </div> --}}
                    <button wire:click="resetTable" class="p-3 bg-primary-400 hover:bg-primary-500 rounded ml-3 text-white">
                        @include('components.icon', ['name' => 'arrow-path', 'size' => 'w-5 h-5'])
                    </button>
                </div>
            </div>
            @if($officers->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pt-6 pb-4">Nama</th>
                            <th class="px-6 pt-6 pb-4">Unit Kerja</th>
                            <th class="px-6 pt-6 pb-4">Email</th>
                            <th class="px-6 pt-6 pb-4">Nomor Induk Pegawai</th>
                            <th class="px-6 pt-6 pb-4">Status</th>
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($officers as $officer)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $officer->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $officer->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $officer->satker->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $officer->email }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 flex items-center">
                                        {{ $officer->bpsid }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        <span class="relative inline-block px-3 py-1 text-sm {{ $officer->aktif == 1 ? 'text-green-900' : 'text-red-900' }}  leading-tight">
                                            <span aria-hidden class="absolute inset-0 {{ $officer->aktif == 1 ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                            <span class="relative">{{ $officer->aktif == 1 ? 'Aktif' : 'Tidak Aktif'}}</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2 text-primary-400 hover:text-primary-600">
                                        <button wire:click="update({{ $officer->id }}, {{ $officer->aktif }})">
                                            @include('components.icon', ['name' => 'arrow-path', 'size' => 'w-5 h-5'])
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
    {{ $officers->links('vendor.livewire.tailwind') }}
</div>
