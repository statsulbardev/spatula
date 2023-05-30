@section('title', 'Pengaturan Pengguna')

<div>
    @include('components.notification.flash')

    <div class="flex flex-no-wrap justify-between mb-8">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Pengguna Aplikasi'])

        {{-- Pengguna Baru --}}
        <a
            href="{{ url(env('APP_URL') . '/pengaturan/pengguna/tambah') }}"
            class="ml-6 p-3 text-white bg-primary-400 hover:bg-primary-500 rounded-md flex items-center">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Tambah Pengguna Baru</span>
        </a>
    </div>

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between">
                {{-- Pencarian --}}
                @include('components.input.search')

                <div class="flex flex-wrap items-center">
                    {{-- Pilih Unit Kerja --}}
                    {{-- @role('superadmin')
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
                    @endrole --}}

                    {{-- Pagination Filter --}}
                    @include('components.input.pagination-selected')
                </div>
            </div>
            @if($users->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pt-6 pb-4">Nama</th>
                            <th class="px-6 pt-6 pb-4">Username</th>
                            <th class="px-6 pt-6 pb-4">Email</th>
                            <th class="px-6 pt-6 pb-4">Unit Kerja</th>
                            <th class="px-6 pt-6 pb-4">Hak Akses</th>
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $user->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $user->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $user->username }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $user->email }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $user->satker->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 flex items-center">
                                        @foreach ($user->roles as $index => $role)
                                            <div class="{{ $index == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">{{ $role->name }}</span>
                                            </div>
                                        @endforeach
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2">
                                        <a
                                            x-data
                                            x-tooltip.raw="Edit Pengguna"
                                            href="{{ url(env('APP_URL') . '/pengaturan/pengguna/' . $user->id . '/edit') }}"
                                            class="text-violet-500 hover:text-violet-600 cursor-pointer">
                                            @include('components.icon', ['name' => 'pencil-square', 'size' => 'w-5 h-5'])
                                        </a>
                                        <button
                                            wire:click="deleteItem({{ $user->id }})"
                                            type="button"
                                            x-data
                                            x-tooltip.raw="Hapus Pengguna"
                                            class="text-red-500 hover:text-red-600"
                                            data-te-toggle="modal"
                                            data-te-target="#deleteModal"
                                            data-te-ripple-init
                                            data-te-ripple-color="light">
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
    {{ $users->links('vendor.livewire.tailwind') }}

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>

@push('scripts')
    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session("messages") }}'
                }));
            }
        </script>

        {{ session()->forget('messages') }}
    @endif
    <script>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>
@endpush
