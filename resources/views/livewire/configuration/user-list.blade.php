@section('title', 'Pengaturan Pengguna')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Pengguna Aplikasi'])

        {{-- Pengguna Baru --}}
        <a href="{{ url(env('APP_URL') . '/pengaturan/pengguna/tambah') }}" wire:navigate
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Tambah Pengguna Baru</span>
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
                    @include('components.input.pagination-selected')
                </div>
            </div>
            @if ($users->isEmpty())
                <div class="w-full flex  justify-center p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-1/3 border-t">
                </div>
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Nama</th>
                            <th class="px-6 pb-4 pt-6">Username</th>
                            <th class="px-6 pb-4 pt-6">Email</th>
                            <th class="px-6 pb-4 pt-6">Unit Kerja</th>
                            <th class="px-6 pb-4 pt-6">Hak Akses</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $user->id }}">
                                </td>
                                <td class="border-t">
                                    <p class="items-center py-4 pl-6">
                                        {{ $user->nama }}
                                    </p>
                                </td>
                                <td class="border-t">
                                    <p class="items-center py-4 pl-6">
                                        {{ $user->username }}
                                    </p>
                                </td>
                                <td class="border-t">
                                    <p class="py-4 pl-6">
                                        {{ $user->email }}
                                    </p>
                                </td>
                                <td class="border-t">
                                    <p class="py-4 pl-6">
                                        {{ $user->satker->nama }}
                                    </p>
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
                                        <a x-data x-tooltip.raw="Edit Pengguna"
                                            href="{{ url(env('APP_URL') . '/pengaturan/pengguna/' . $user->id . '/edit') }}" wire:navigate
                                            class="cursor-pointer text-violet-500 hover:text-violet-600">
                                            @include('components.icon', [
                                                'name' => 'pencil-square',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        <button wire:click="deleteItem({{ $user->id }})" type="button" x-data
                                            x-tooltip.raw="Hapus Pengguna" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
                                            data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
                                            @include('components.icon', [
                                                'name' => 'trash',
                                                'size' => 'w-5 h-5',
                                            ])
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

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>
