@section('title', 'Pemanggil Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Pemanggil Antrian'])

    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}

    <section class="mb-6 mt-10">
        <div wire:poll.300s class="overflow-x-auto rounded-md bg-white shadow mb-5">
            <div class="flex flex-wrap items-center justify-between p-4 pt-0 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 w-full">
                    @foreach ($show_data as $item_show)
                        <div class="rounded-sm border border-stroke bg-slate-100 px-3 py-1">
                            <div class="text-sm font-bold">Loket {{$item_show['loket']}}</div>
                            @if ($item_show['active'])
                                <div class="text-6xl font-bold w-full text-center my-3">{{$item_show['active']['antrian']}}</div>
                            @else
                                <div class="text-6xl font-bold w-full text-center my-3">-</div>
                            @endif
                            
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
    </section>
</div>
