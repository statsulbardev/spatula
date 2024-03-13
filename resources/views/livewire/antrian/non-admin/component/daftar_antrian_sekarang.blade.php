<div wire:poll.300s class="w-full overflow-x-auto rounded-md bg-white shadow mb-5">
    <h1 class="text-md lg:text-xl font-bold mx-4 my-3">DASHBOARD ANTRIAN HARI INI : </h1>
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
    <div class="flex flex-wrap items-center justify-between p-4 pt-0">
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
                        @if (count($item_show['antrian_ku']) > 0)
                            <div class="text-sm my-3 text-left">
                                Antrian anda : {{$item_show['antrian_ku'][0]['antrian']}}
                            </div>
                        @endif
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>
