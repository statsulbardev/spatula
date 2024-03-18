@section('title', 'Pemanggil Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Pemanggil Antrian'])
        {{-- Rearange Data --}}
        <button wire:click="rearrange" type="button"
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            @include('components.icon', ['name' => 'cursor-arrow-ripple', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Rearrange</span>
        </button>
    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}

    <section class="mb-6 mt-10">
        <div wire:poll.keep-alive.300s class="overflow-x-auto rounded-md bg-white shadow mb-5">
            <div class="flex flex-wrap items-center justify-between p-4 pt-0 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full p-3">
                    @foreach ($show_data as $item_show)
                        <div class="rounded-md drop-shadow-lg border border-stroke bg-slate-100 px-3 py-1">
                            <div class="text-sm font-bold">Loket {{$item_show['loket']}}</div>
                            @if ($item_show['active'])
                                <div class="text-7xl font-bold w-full text-center my-3">{{$item_show['active']['antrian']}}</div>
                            @else
                                <div class="text-7xl font-bold w-full text-center my-3">-</div>
                            @endif

                            <div class="w-full flex flex-col justify-center my-2 mt-3">
                                @if ($item_show['active'])
                                    <p class="w-full text-center text-md">{{$item_show['active']['konsumen_nama']}}</p>
                                    <div class="flex gap-x-1">
                                        <button wire:click="belum_selesaikan_dan_next('{{ $item_show['active']->id }}' , '{{$item_show['loket']}}')"
                                            class="flex-grow bg-gray-400 hover:bg-gray-600 p-1 text-white rounded-sm text-sm">
                                                Langkahi
                                        </button>
                                        <button wire:click="selesaikan_dan_next('{{ $item_show['active']->id }}' , '{{$item_show['loket']}}')"
                                            class="flex-grow bg-green-500 hover:bg-green-700 p-1 text-white rounded-sm text-sm">
                                                Selesai
                                        </button>
                                    </div>
                                    
                                @else
                                    <p class="w-full text-center text-md">-</p>
                                    <button wire:click="mulai_dan_next('{{$item_show['loket']}}')"
                                        class="bg-yellow-500 hover:bg-yellow-700 p-1 text-white rounded-sm text-sm">
                                            Mulai
                                    </button>
                                @endif
                                <div class="w-full">
                                    <div class="flex gap-x-1">
                                        @if ($item_show['active'])
                                            <button wire:click="call_the_active('{{ $item_show['active']->id }}')"
                                                class="flex-grow bg-blue-500 hover:blue-700 p-1 text-white rounded-sm text-sm mt-1">
                                                    Panggil Antrian
                                            </button>
                                        @endif
                                    
                                        <button wire:click="reset_active('{{$item_show['loket']}}')"
                                            class="flex-grow bg-gray-500 hover:gray-700 p-1 text-white rounded-sm text-sm mt-1">
                                                Reset Antrian
                                        </button>
                                    </div>
                                </div>
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
                                            <th class="px-1 py-2 border border-1 border-slate-500">Konsumen</th>
                                            <th class="px-1 py-2 border border-1 border-slate-500">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item_show['daftar'] as  $item_antrian)
                                            <tr>
                                                <td class="px-1 py-2 text-center border border-1 border-slate-500">{{$item_antrian->antrian}}</td>
                                                <td class="px-1 py-2 border border-1 border-slate-500">
                                                    <div class="">
                                                        <div class="text-md">{{$item_antrian->konsumen_nama}}</div>
                                                        <div class="text-sm text-neutral-500">{{$item_antrian->konsumen_email}}</div>
                                                        <div class="text-sm text-primary-500">{{$item_antrian->layanan->nama_layanan}}</div>
                                                    </div> 
                                                </td>
                                                <td class="px-1 py-2 border border-1 border-slate-500">
                                                @if ($item_antrian->status == 0)
                                                    Belum
                                                @elseif ($item_antrian->status == 1)
                                                    Aktif
                                                @elseif ($item_antrian->status == 2)
                                                    Selesai
                                                @endif
                                                </td>
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
    </section>
</div>
