@section('title', 'Dashboard Antrian')
<div class="flex justify-center">
    <div wire:poll.300s class="overflow-x-auto rounded-md bg-white shadow mb-5">
        <div class="flex p-4">
            <h1 class="text-md lg:text-xl font-bold my-3">DASHBOARD ANTRIAN HARI INI : </h1>
            <div class="flex-grow"></div>
            <a href="{{ route('antrian-non-admin-item-tambah') }}" wire:navigate
                class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
                @include('components.icon', ['name' => 'plus-circle', 'size' => 'w-5 h-5'])
                <span class="ml-2 text-sm">Daftar Antrian</span>
            </a>
        </div>
        
        <hr class="mb-4 mx-4">
        <div class="flex flex-wrap items-center justify-between p-4 pt-0">
            <div class="flex flex-wrap w-full">
                <div wire:ignore
                    x-init="() => { 
                        window.te.Select.getOrCreateInstance(document.querySelector('#unit_kerja')).setValue('{{ $this->kode_satker }}')
                    }" class="w-full">
                    <select id="unit_kerja" wire:model.lazy="kode_satker" data-te-select-filter="true">
                        <option hidden selected>Pilih Unit Kerja ...</option>
                        {!! $this->units !!}
                    </select>
                </div>
            </div>
        </div>
        <div wire:key="{{ rand() }}" class="flex flex-wrap items-center justify-between p-4 pt-0">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 w-full">
                @foreach ($show_data as $item_show)
                    <div class="rounded-sm border border-stroke bg-slate-100 px-3 py-1">
                        <div class="text-sm font-bold">Loket {{$item_show['loket']}}</div>
                        @if ($item_show['active'])
                            <div class="text-7xl font-bold w-full text-center my-3">{{$item_show['loket']}}{{$item_show['active']['antrian']}}</div>
                        @else
                            <div class="text-7xl font-bold w-full text-center my-3">-</div>
                        @endif

                        <div class="w-full flex flex-col justify-center mx-3 my-2 mt-3">
                            @if ($item_show['active'])
                                <p class="w-full text-center text-md">{{$item_show['active']['konsumen_nama']}}</p>
                            @endif
                        </div>
                        
                        <hr class="border-zinc-400">
                        <div class="text-sm leading-tight text-justify my-1.5">
                            <div>{{implode(', ', $item_show['layanan'])}}</div>
                        </div>
                        @if (count($item_show['daftar']) > 0)
                            <hr class="border-zinc-400">
                            <p class="text-sm leading-tight text-justify my-1.5 mt-2 font-medium">Daftar Antrian:</p>
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-neutral-100 text-left font-bold">
                                        <th class="px-1 py-2 text-center border border-1 border-slate-500">No</th>
                                        <th class="px-1 py-2 border border-1 border-slate-500">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item_show['daftar'] as  $item_antrian)
                                        <tr>
                                            <td class="px-1 py-2 text-center border border-1 border-slate-500">{{$item_antrian->antrian}}</td>
                                            <td class="px-1 py-2 border border-1 border-slate-500">{{$item_antrian->konsumen_nama}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

