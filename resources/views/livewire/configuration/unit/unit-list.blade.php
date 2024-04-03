<div>
    <div class="flex flex-nowrap items-center justify-between">
        <x-page.page-title :title="$pageTitle" />

        {{-- Satker Baru --}}
        <a
            href="{{ route('unit.create') }}"
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500"
            wire:navigate>
            <x-icons.hero name="plus-circle-solid" size="w-5 h-5" />
            <span class="ml-2 text-sm">Satker</span>
        </a>
    </div>

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                <x-forms.inputs.search />

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

                    <x-forms.attributes.pagination-selected />
                </div>
            </div>
            @if ($offices->isEmpty())
                <div class="w-full flex  justify-center p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
                </div>
            @else
                <table class="w-full table-auto text-base font-light">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th scope="col" class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                            </th>
                            <th scope="col" class="px-6 pb-4 pt-6">Kode Satker</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Nama Satker</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Alamat</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Web</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Telepon</th>
                            <th scope="col" class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $office)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $office->id }}">
                                </td>
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $office->kode_satker }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $office->nama }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        {{ $office->alamat ?? 'Alamat satker tidak tersedia'}}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        {{ $office->web ?? 'Website satker tidak tersedia' }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        {{ $office->telepon ?? 'Telepon satker tidak tersedia' }}
                                    </div>
                                </td>
                                <td class="w-px border-t">
                                    <div class="mr-2 flex items-center space-x-2 py-2">
                                        <a
                                            x-data
                                            x-tooltip.raw="Edit Satker"
                                            href="{{ route('unit.edit', $office->id) }}"
                                            class="cursor-pointer text-violet-500 hover:text-violet-600"
                                            wire:navigate>
                                            <x-icons.hero name="pencil-square-outline" size="w-5 h-5" />
                                        </a>
                                        <button
                                            wire:click="deleteItem({{ $office->id }})"
                                            type="button"
                                            x-data
                                            x-tooltip.raw="Hapus Satker" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
                                            data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
                                            <x-icons.hero name="trash-outline" size="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
    {{ $offices->links('vendor.livewire.tailwind') }}

    <x-forms.attributes.delete-confirmation />
</div>
