@section('title', 'Daftar Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Antrian'])

        {{-- Antrian Baru --}}
        <a href="{{ url(env('APP_URL') . '/pengaturan/antrian/daftar/tambah') }}" wire:navigate
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Tambah Antrian Baru</span>
        </a>
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
            <div class="flex flex-wrap items-center justify-between p-4">
                <div class="flex flex-wrap" wire:ignore>
                    <label class="form-label font-bold" for="Tanggal Kunjungan">
                        Tanggal Kunjungan
                    </label>
                    <input type='date' class="border border-1 w-full p-2 rounded-md border-slate-400 disabled:bg-gray-200 disabled:text-slate-900"
                        type="text" id="tanggal_filter_id" wire:model.lazy="tanggal_filter"
                        placeholder="Tanggal Kunjungan"/>
                </div>
            </div>
            @if (count($data) == 0)
                <div class="w-full flex  justify-center p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
                </div>
            @else
            <div class="px-4">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-3 pb-4 pt-6 text-center">No</th>
                            <th class="px-6 pb-4 pt-6">Layanan</th>
                            <th class="px-6 pb-4 pt-6">Konsumen</th>
                            <th class="px-6 pb-4 pt-6 text-center">Tanggal</th>
                            <th class="px-6 pb-4 pt-6 text-center">Periode</th>
                            <th class="px-6 pb-4 pt-6 text-center">Antrian</th>
                            <th class="px-6 pb-4 pt-6 text-center">Tujuan</th>
                            <th class="px-6 pb-4 pt-6 text-center"></th>
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
                                            <div class="text-sm text-primary-500">LOKET {{$master_key_value[$item->kode_satker.'--'.$item->kode_layanan]}}</div>
                                        @endif
                                        
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="px-6 pb-4 whitespace-nowrap">
                                        <div class="text-md">{{$item->konsumen_nama}}</div>
                                        <div class="mb-2 text-sm text-neutral-500">{{$item->konsumen_email}}</div>
                                    </div>
                                </td>
                                <td class="border-t px-6 pb-4 text-center">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="border-t px-6 pb-4 items-center text-center">
                                    @if ($item->periode == 0)
                                        Jam Pertama<br>(Sebelum Istirahat)
                                    @elseif ($item->periode == 1)
                                        Jam Kedua<br>(Setelah Istirahat)
                                    @endif
                                </td>
                                <td class="border-t px-6 pb-4 items-center text-center">
                                    {{$item->antrian}}
                                </td>
                                <td class="border-t px-6 pb-4 items-center text-center whitespace-nowrap">
                                    {!!$item->deskripsi!!}
                                </td>
                                <td class="border-t px-6 pb-4">
                                    <div class="flex items-center justify-center">
                                        <a x-data x-tooltip.raw="Lihat Antrian" class="text-purple-400 hover:text-purple-500"
                                            href="{{ route('antrian-daftar-lihat', ['antrian_satker' => $item->id]) }}"
                                            wire:navigate>
                                            @include('components.icon', [
                                                'name' => 'eye',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        @if ($item->tanggal >= \Carbon\Carbon::today()->format('Y-m-d'))
                                            <a x-data x-tooltip.raw="Ubah Antrian" class="text-green-400 hover:text-green-500"
                                                href="{{ route('antrian-daftar-ubah', ['antrian_satker' => $item->id]) }}"
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
            </div>
            @endif
        </div>
        @include('components.input.delete-confirmation')
    </section>
</div>
