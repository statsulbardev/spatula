<div class="px-4 md:px-6 2xl:px-11 py-8">
    <div class="flex flex-nowrap items-center justify-between">
        <x-page.page-title title="Daftar Pengguna Aplikasi" />

        <a
            href="{{ route('user.create') }}"
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500"
            wire:navigate>
            <x-icons.hero name="plus-circle-solid" size="w-5 h-5" />
            <span class="ml-2 text-sm">Pengguna Baru</span>
        </a>
    </div>

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                <x-forms.inputs.search />

                <div class="flex flex-wrap items-center">
                    {{-- Pilih Unit Kerja --}}
                    {{-- @role('superadmin')
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
                    <x-forms.attributes.pagination-selected />
                </div>
            </div>
            @if ($users->isEmpty())
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
                            <th scope="col" class="px-6 pb-4 pt-6">Nama</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Username</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Email</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Unit Kerja</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Hak Akses</th>
                            <th scope="col" class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $user->id }}">
                                </td>
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $user->nama }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $user->username }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        {{ $user->satker->nama }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="flex items-center py-4 pl-6">
                                        @foreach ($user->roles as $index => $role)
                                            <div
                                                class="{{ $index == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm leading-tight text-green-900">
                                                <p aria-hidden class="absolute inset-0 rounded-full bg-green-200 opacity-50"></p>
                                                <p class="relative">{{ $role->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="w-px border-t">
                                    <div class="mr-2 flex items-center space-x-2 py-2">
                                        <a
                                            wire:navigate
                                            x-data
                                            x-tooltip.raw="Edit Pengguna"
                                            href="{{ route('user.edit', $user->id) }}"
                                            class="cursor-pointer text-violet-500 hover:text-violet-600">
                                            <x-icons.hero name="pencil-square-outline" size="w-5 h-5" />
                                        </a>
                                        <button
                                            wire:click="deleteItem({{ $user->id }})"
                                            type="button"
                                            x-data
                                            x-tooltip.raw="Hapus Pengguna"
                                            class="text-red-500 hover:text-red-600" data-te-toggle="modal"
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

    {{ $users->links('vendor.livewire.tailwind') }}

    <x-forms.attributes.delete-confirmation />
</div>
