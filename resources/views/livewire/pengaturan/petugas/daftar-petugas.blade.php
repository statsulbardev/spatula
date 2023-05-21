@section('title', 'Pengaturan Petugas')

<div>
    {{-- Notification --}}
    @include('components.notification.flash')

    <div class="flex flex-no-wrap justify-between mb-8">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Petugas Layanan'])

        {{-- Tambah Petugas --}}
        <a
            href="{{ url(env('APP_URL') . '/pengaturan/petugas/tambah') }}"
            class="ml-6 p-3 text-white bg-primary-400 hover:bg-primary-500 rounded-md flex items-center">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Tambah Petugas</span>
        </a>
    </div>

    {{-- Content --}}
    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between">
                {{-- Pencarian --}}
                @include('components.input.search')

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
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
                            <th class="px-6 pt-6 pb-4">Email</th>
                            <th class="px-6 pt-6 pb-4">Unit Kerja</th>
                            <th class="px-6 pt-6 pb-4">Role</th>
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
                                        {{ $officer->email }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $officer->satker->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 flex items-center">
                                        @foreach ($officer->roles as $index => $role)
                                            <div class="{{ $index == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">{{ $role->name }}</span>
                                            </div>
                                        @endforeach
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <a
                                            x-data
                                            x-tooltip.raw="Edit Petugas"
                                            href="{{ url(env('APP_URL') . '/pengaturan/petugas/' . $officer->id . '/edit') }}"
                                            class="text-violet-500 hover:text-violet-600 cursor-pointer">
                                            @include('components.icon', ['name' => 'pencil-square', 'size' => 'w-5 h-5'])
                                        </a>
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
