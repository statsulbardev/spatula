<div class="w-full overflow-x-auto rounded-md bg-white shadow">
    <h1 class="text-md lg:text-xl font-bold mx-4 my-3">SEJARAH ANTRIAN : </h1>
    <hr class="mb-4 mx-4">
    <div class="flex flex-wrap items-center justify-between p-4 pt-0">
        <div class="flex flex-wrap items-center w-full gap-2">
            <div>
                <label for="selectedMonth_id" class="text-sm text-primary-400 font-bold tracking-wider">Bulan</label>
                <select id="selectedMonth_id" wire:model.live="selectedMonth" class="form-select min-w-48">
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
            </div>
            <div>
                <label for="selectedYear_id" class="text-sm text-primary-400 font-bold tracking-wider">Tahun</label>
                <select id="selectedYear_id" wire:model.live="selectedYear" class="form-select min-w-48">
                    <option hidden selected>Pilih Tahun...</option>
                    @foreach ($this->years as $item)
                        @if ($selectedYear == $item)
                            <option value="{{ $item }}" selected>{{ $item }}</option>
                        @else
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex grow"></div>
            <div class="flex-none">
                <x-forms.attributes.pagination-selected />
            </div>
        </div>

        {{-- Pagination Filter --}}

    </div>
    @if ($data->isEmpty())
        <div class="w-full flex  justify-center p-5">
            <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
        </div>
    @else
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-neutral-100 text-left font-bold">
                    <th class="px-3 pb-4 pt-6 text-center">No</th>
                    <th class="px-6 pb-4 pt-6">Layanan</th>
                    <th class="px-6 pb-4 pt-6 text-center">Tanggal</th>
                    <th class="px-6 pb-4 pt-6 text-center">Periode</th>
                    <th class="px-6 pb-4 pt-6 text-center">Antrian</th>
                    <th class="px-6 pb-4 pt-6 text-center">Tujuan</th>
                    <th class="px-6 pb-4 pt-6"></th>
                </tr>
            </thead>
            <tbody wire:key="{{ rand() }}">
                @foreach ($data as $item)
                    <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                        <td class="border-t px-3 pb-4 items-center text-center">
                            {{$loop->index + 1}}
                        </td>
                        <td class="border-t">
                            <div class="px-6 pb-4 whitespace-nowrap">
                                <div class="text-md">{{$item->satker->nama}}</div>
                                <div class="mb-2 text-sm text-neutral-500">{{$item->layanan->nama_layanan}}</div>
                                @if ($item->tanggal == $today_tanggal)
                                    @if (array_key_exists($item->kode_satker.'--'.$item->kode_layanan, $master_key_value))
                                        <div class="text-sm text-primary-500">LOKET {{$master_key_value[$item->kode_satker.'--'.$item->kode_layanan]}}</div>
                                    @else
                                        <div class="text-sm text-primary-500">LOKET ??</div>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="border-t px-6 pb-4 text-center">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal)->format('d/m/Y') }}
                        </td>
                        <td class="border-t px-6 pb-4 items-center text-center">
                            @if ($item->periode == 0)
                                Jam Pertama (Sebelum Istirahat)
                            @elseif ($item->periode == 1)
                                Jam Kedua (Setelah Istirahat)
                            @endif
                        </td>
                        <td class="border-t px-6 pb-4 items-center text-center">
                            @if ($item->tanggal == $today_tanggal && array_key_exists($item->kode_satker.'--'.$item->kode_layanan, $master_key_value))
                                {{$master_key_value[$item->kode_satker.'--'.$item->kode_layanan]}}{{$item->antrian}}
                            @elseif ($item->tanggal == $today_tanggal && !array_key_exists($item->kode_satker.'--'.$item->kode_layanan, $master_key_value))
                                Belum Tersedia
                            @else
                                {{$item->antrian}}
                            @endif
                        </td>
                        <td class="border-t px-6 pb-4 items-center text-center whitespace-nowrap">
                            {!!$item->deskripsi!!}
                        </td>
                        <td class="border-t px-6 pb-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a x-data x-tooltip.raw="Lihat Antrian" class="text-purple-400 hover:text-purple-500"
                                    href="{{ route('antrian-non-admin-item-lihat', ['antrian_satker' => $item->id]) }}"
                                    wire:navigate>
                                    <x-icons.hero name="eye-outline" size="w-5 h-5" />
                                </a>
                                @if ($item->tanggal >= \Carbon\Carbon::today()->format('Y-m-d'))
                                    <a x-data x-tooltip.raw="Ubah Antrian" class="text-green-400 hover:text-green-500"
                                        href="{{ route('antrian-non-admin-item-edit', ['antrian_satker' => $item->id]) }}"
                                        wire:navigate>
                                        <x-icons.hero name="pencil-square-outline" size="w-5 h-5" />
                                    </a>
                                    <button wire:click="deleteItem('{{ $item->id }}')" type="button" x-data
                                        x-tooltip.raw="Hapus Antrian" class="text-red-500 hover:text-red-600" data-te-toggle="modal"
                                        data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
                                        <x-icons.hero name="trash-outline" size="w-5 h-5" />
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
