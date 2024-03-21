<div class="px-4 md:px-6 2xl:px-11 py-8">
    <div class="flex flex-nowrap items-center justify-between">
        <x-page.page-title title="Pengaturan Layanan" />

        <div class="flex flex-nowrap space-x-5">
            <ul class="flex flex-nowrap" role="tablist" data-te-nav-ref>
                <li class="border-l-2 border-t-2 border-b-2 border-primary-100 drop-shadow-sm rounded-l-md bg-white px-4 py-2 font-medium leading-tight hover:bg-gray-300"
                    role="presentation">
                    <a
                        href="master-layanan"
                        class="align-middle text-sm text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary-500"
                        data-te-toggle="pill"
                        data-te-target="#master-layanan"
                        data-te-nav-active
                        role="tab"
                        aria-controls="master-layanan"
                        aria-selected="true">
                        Master Layanan
                    </a>
                </li>
                <li class="border-2 border-primary-100 drop-shadow-sm rounded-r-md bg-white px-4 py-2 font-medium leading-tight hover:bg-gray-300"
                    role="presentation">
                    <a
                        href="layanan-satker"
                        class="align-middle text-sm text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary-500"
                        data-te-toggle="pill"
                        data-te-target="#layanan-satker"
                        role="tab"
                        aria-controls="layanan-satker"
                        aria-selected="false">
                        Layanan Satker
                    </a>
                </li>
            </ul>
            <x-partials.button.create-button :route="route('service.create')" title="Layanan" />
        </div>
    </div>

    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div>
                {{-- Master Layanan --}}
                <div
                    class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="master-layanan"
                    role="tabpanel"
                    aria-labelledby="master-layanan-tab"
                    data-te-tab-active>
                    <div class="flex flex-wrap justify-between p-4">
                        {{-- Pencarian --}}
                        @include('components.input.search')
                        <div class="flex flex-wrap items-center">
                            {{-- Pagination Filter --}}
                            @include('components.input.pagination-selected')
                        </div>
                    </div>
                    @if ($services->isEmpty())
                        <div class="w-full flex  justify-center p-5">
                            <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
                        </div>
                    @else
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-neutral-100 text-left font-bold">
                                    <th class="px-6 pb-4 pt-6">
                                        <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                                    </th>
                                    <th scope="col" class="px-6 pb-4 pt-6">Kode</th>
                                    <th scope="col" class="px-6 pb-4 pt-6">Nama Layanan</th>
                                    <th scope="col" class="px-6 pb-4 pt-6">Metode</th>
                                    <th scope="col" class="px-6 pb-4 pt-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                    <td class="w-2 border-t px-6 py-4">
                                        <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $service->id }}">
                                    </td>
                                    <td class="border-t">
                                        <p class="py-4 pl-6">
                                            {{ $service->kode_layanan }}
                                        </p>
                                    </td>
                                    <td class="border-t">
                                        <p class="py-4 pl-6">
                                            {{ $service->nama_layanan }}
                                        </p>
                                    </td>
                                    <td class="border-t pl-6">
                                        {{ $service->metode === '1' ? 'Luar Jaringan (Offline/Tatap Muka)' : 'Dalam Jaringan (Online)' }}
                                    </td>
                                    <td class="w-px border-t">
                                        <div class="mr-2 flex items-center space-x-2 py-2">
                                            <a
                                                x-data
                                                x-tooltip.raw="Edit Layanan"
                                                href="{{ route('service.edit', $service->id) }}"
                                                class="cursor-pointer text-violet-400 hover:text-violet-500"
                                                wire:navigate>
                                                <x-icons.heroline name="pencil-square" size="w-5 h-5" />
                                            </a>
                                            <button
                                                type="button"
                                                x-data
                                                x-tooltip.raw="Set Layanan Satker"
                                                wire:click="setUnitService({{ $service->id }})"
                                                class="text-orange-400 hover:text-orange-600"
                                                data-te-ripple-init
                                                data-te-ripple-color="light">
                                                <x-icons.heroline name="arrow-down-on-square-stack" size="w-5 h-5" />
                                            </button>
                                            <button
                                                type="button"
                                                x-data
                                                x-tooltip.raw="Hapus Layanan"
                                                wire:click="deleteItem({{ $service->id }})"
                                                class="text-red-500 hover:text-red-600"
                                                data-te-toggle="modal"
                                                data-te-target="#deleteModal"
                                                data-te-ripple-init
                                                data-te-ripple-color="light">
                                                <x-icons.heroline name="trash" size="w-5 h-5" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                {{-- Layanan Satker --}}
                <div
                    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="layanan-satker"
                    role="tabpanel"
                    aria-labelledby="layanan-satker-tab">
                    @if ($unitService->isEmpty())

                    @else
                        <p class="p-4 font-medium text-lg">Layanan yang Tersedia Pada Satker {{ auth()->user()->satker->nama }} yaitu :</p>
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-neutral-100 text-left font-bold">
                                    <th scope="col" class="px-6 pb-4 pt-6">Nama Layanan</th>
                                    <th scope="col" class="px-6 pb-4 pt-6">Metode</th>
                                    <th scope="col" class="px-6 pb-4 pt-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unitService as $unitItem)
                                <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                    <td class="border-t">
                                        <p class="py-4 pl-6">
                                            {{ $unitItem->nama_layanan }}
                                        </p>
                                    </td>
                                    <td class="border-t pl-6">
                                        {{ $unitItem->metode === '1' ? 'Luar Jaringan (Offline/Tatap Muka)' : 'Dalam Jaringan (Online)' }}
                                    </td>
                                    <td class="w-px border-t">
                                        <div class="mr-2 flex items-center space-x-2 py-2">
                                            <button
                                                type="button"
                                                x-data
                                                x-tooltip.raw="Hapus Layanan"
                                                wire:click="removeUnitService({{ auth()->user()->satker->id }}, {{ $unitItem->id }})"
                                                class="text-red-500 hover:text-red-600">
                                                <x-icons.heroline name="trash" size="w-5 h-5" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>

    </section>

    {{ $services->links('vendor.livewire.tailwind') }}

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>
