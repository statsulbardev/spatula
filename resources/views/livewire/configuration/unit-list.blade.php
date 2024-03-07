@section('title', 'Pengaturan Satker')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Satuan Kerja'])

        {{-- Satker Baru --}}
        <a href="{{ url(env('APP_URL') . '/pengaturan/satker/tambah') }}"
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Tambah Satker</span>
        </a>
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                {{-- Pencarian --}}
                @include('components.input.search')

                <div class="flex flex-wrap items-center">
                    {{-- Pilih Unit Kerja --}}
                    {{-- @role('admin')
                    <div class="pr-6 ml-6 border-r-2 border-zinc-200">
                        <div wire:ignore class="w-80">
                            <select wire:model.live="selectedUnit" data-te-select-init data-te-select-filter="true"
                                data-te-select-size="lg">
                                <option value="null" hidden selected>Pilih Unit Kerja...</option>
                                @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                @endforeach
                            </select>
                            <label data-te-select-label-ref>Unit Kerja</label>
                        </div>
                    </div>
                    @endrole --}}

                    {{-- Pagination Filter --}}
                    @include('components.input.pagination-selected')
                </div>
            </div>
            @if ($offices->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Kode Satker</th>
                            <th class="px-6 pb-4 pt-6">Nama Satker</th>
                            <th class="px-6 pb-4 pt-6">Alamat</th>
                            <th class="px-6 pb-4 pt-6">Web</th>
                            <th class="px-6 pb-4 pt-6">Telepon</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $office)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $office->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
                                        {{ $office->kode_satker }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
                                        {{ $office->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        {{ $office->alamat }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        {{ $office->web }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        {{ $office->telepon }}
                                    </span>
                                </td>
                                <td class="w-px border-t">
                                    <span class="mr-2 flex items-center space-x-2 py-2">
                                        <a x-data x-tooltip.raw="Edit Satker"
                                            href="{{ url(env('APP_URL') . '/pengaturan/satker/' . $office->id . '/edit') }}"
                                            class="cursor-pointer text-violet-500 hover:text-violet-600">
                                            @include('components.icon', [
                                                'name' => 'pencil-square',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        <button wire:click="deleteItem({{ $office->id }})" type="button" x-data
                                            x-tooltip.raw="Hapus Satker" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
                                            data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
                                            @include('components.icon', [
                                                'name' => 'trash',
                                                'size' => 'w-5 h-5',
                                            ])
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
    {{ $offices->links('vendor.livewire.tailwind') }}

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>

@push('scripts')
    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session('messages') }}'
                }));
            }
        </script>

        {{ session()->forget('messages') }}
    @endif
@endpush
