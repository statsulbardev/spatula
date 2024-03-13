<div class="w-full overflow-x-auto rounded-md bg-white shadow">
    <h1 class="text-md lg:text-xl font-bold mx-4 my-3">SEJARAH ANTRIAN : </h1>
    <hr class="mb-4 mx-4">
    <div class="flex flex-wrap items-center justify-between p-4 pt-0">
        <div class="flex flex-wrap">
            <div wire:ignore>
                <select id="selectedMonth_id" 
                    wire:model.live="selectedMonth" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                    <option hidden selected>Pilih Bulan...</option>
                    @foreach ($this->months as $month)
                        @foreach ($month as $index => $item)
                            @if ($selectedMonth == $month)
                                <option value="{{ $index }}" selected>{{ $item }}</option>
                            @else
                                <option value="{{ $index }}">{{ $item }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
                <label data-te-select-label-ref>Bulan</label>
            </div>
            <div wire:ignore class="ml-4">
                <select id="selectedYear_id" 
                    wire:model.live="selectedYear" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                    <option hidden selected>Pilih Tahun...</option>
                    @foreach ($this->years as $item)
                        @if ($selectedYear == $item)
                            <option value="{{ $item }}" selected>{{ $item }}</option>
                        @else
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </select>
                <label data-te-select-label-ref>Tahun</label>
            </div>
        </div>

        {{-- Pagination Filter --}}
        @include('components.input.pagination-selected')
    </div>
    @if ($data->isEmpty())
        <div class="w-full flex  justify-center p-5">
            <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
        </div>
    @else
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-neutral-100 text-left font-bold">
                    <th class="px-6 pb-4 pt-6 text-center">No</th>
                    <th class="px-6 pb-4 pt-6">Layanan</th>
                    <th class="px-6 pb-4 pt-6 text-center">Tanggal</th>
                    <th class="px-6 pb-4 pt-6 text-center">Antrian</th>
                    <th class="px-6 pb-4 pt-6"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                        <td class="border-t px-6 pb-4 items-center text-center">
                            {{$loop->index + 1}}
                        </td>
                        <td class="border-t">
                            <div class="px-6 pb-4">
                                <div class="text-md">{{$item->satker->nama}}</div>
                                <div class="mb-2 text-sm text-neutral-500">{{$item->layanan->nama_layanan}}</div>
                                <div class="text-sm text-primary-500">LOKET {{$master_key_value[$item->kode_satker.'--'.$item->kode_layanan]}}</div>
                            </div>
                        </td>
                        <td class="border-t px-6 pb-4 text-center">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal)->format('d/m/Y') }}
                        </td>
                        <td class="border-t px-6 pb-4 items-center text-center">
                            {{$item->antrian}}
                        </td>
                        <td class="border-t px-6 pb-4">
                            <div class="flex items-center justify-center">
                                <a x-data x-tooltip.raw="Lihat Antrian" class="text-purple-400 hover:text-purple-500"
                                    href="{{ route('antrian-non-admin-item-lihat', ['antrian_satker' => $item->id]) }}"
                                    wire:navigate>
                                    @include('components.icon', [
                                        'name' => 'eye',
                                        'size' => 'w-5 h-5',
                                    ])
                                </a>
                                @if ($item->tanggal >= \Carbon\Carbon::today()->format('Y-m-d'))
                                    <a x-data x-tooltip.raw="Edit Antrian" class="text-green-400 hover:text-green-500"
                                        href="{{ route('antrian-non-admin-item-edit', ['antrian_satker' => $item->id]) }}"
                                        wire:navigate>
                                        @include('components.icon', [
                                            'name' => 'pencil-square',
                                            'size' => 'w-5 h-5',
                                        ])
                                    </a>
                                    <button wire:click="deleteItem({{ $item->id }})" type="button" x-data
                                        x-tooltip.raw="Hapus Antrian" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
                                        data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
                                        @include('components.icon', [
                                            'name' => 'trash',
                                            'size' => 'w-5 h-5',
                                        ])
                                    </button>
                                @endif
                            </div>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @include('components.input.delete-confirmation')
</div>
