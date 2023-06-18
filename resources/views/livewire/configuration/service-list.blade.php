@section('title', 'Pengaturan Daftar Layanan')

<div class="px-4 md:px-6 2xl:px-11 py-8">
    @include('components.notification.flash')

    <div class="flex flex-nowrap items-center justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Pengaturan Layanan'])

        {{-- Layanan Baru --}}
        <a href="{{ url(env('APP_URL') . '/pengaturan/layanan/tambah') }}"
            class="flex items-center rounded-md bg-primary-400 p-1 text-white hover:bg-primary-500 lg:p-3">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-1 text-xs md:ml-2 md:text-sm">Tambah Layanan</span>
        </a>
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                {{-- Pencarian --}}
                @include('components.input.search')
                <div class="flex flex-wrap items-center">
                    {{-- Pagination Filter --}}
                    @include('components.input.pagination-selected')
                </div>
            </div>
            @if ($services->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Kode Layanan</th>
                            <th class="px-6 pb-4 pt-6">Nama Layanan</th>
                            <th class="px-6 pb-4 pt-6">Deskripsi Layanan</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $service->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        {{ $service->kode_layanan }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        {{ $service->nama_layanan }}
                                    </span>
                                </td>
                                <td class="border-t pl-6">
                                    {!! $service->deskripsi ?? '<span class="py-4">Lorem Ipsum Dolor Sit Amet</span>' !!}
                                </td>
                                <td class="w-px border-t">
                                    <span class="mr-2 flex items-center space-x-2 py-2">
                                        <a x-data x-tooltip.raw="Edit Layanan"
                                            href="{{ url(env('APP_URL') . '/pengaturan/layanan/' . $service->id . '/edit') }}"
                                            class="cursor-pointer text-violet-400 hover:text-violet-500">
                                            @include('components.icon', [
                                                'name' => 'pencil-square',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        <button wire:click="deleteItem({{ $service->id }})" type="button" x-data
                                            x-tooltip.raw="Hapus Layanan" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
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
    {{ $services->links('vendor.livewire.tailwind') }}

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
    <script>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>
@endpush
