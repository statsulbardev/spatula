@section('title', 'Daftar Layanan Antrian')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    <div class="flex-no-wrap flex justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Daftar Layanan Antrian'])

    </div>

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    {{-- Content --}}
    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow pb-2">
           
            @if ($data->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">Nama Satker</th>
                            <th class="px-6 pb-4 pt-6">Nama Layanan</th>
                            <th class="px-6 pb-4 pt-6">Antrian Online</th>
                            <th class="px-6 pb-4 pt-6">Nama Loket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                                <td class="border-t">
                                    <span class="items-center py-6 pl-6">
                                        {{ $item->satker->nama }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="items-center py-6 pl-6">
                                        {{ $item->layanan->nama_layanan }}
                                    </span>
                                </td>
                                <td class="border-t py-6 pl-6">
                                    <select class="w-1/2 py-2 px-2" wire:change="changeValueActive({{ $item->kode_satker }}, {{ $item->kode_layanan }}, $event.target.value)">
                                        @if ($item->is_active == 1)
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        @elseif ($item->is_active == 0)
                                            <option value="1">Aktif</option>
                                            <option value="0" selected>Tidak Aktif</option>
                                        @endif
                                    </select>
                                </td>
                                <td class="border-t py-6 pl-6">
                                    @if ($item->is_active == 1)
                                    <select class="w-1/2 py-2 px-2" wire:change="changeValueLoket({{ $item->kode_satker }}, {{ $item->kode_layanan }}, $event.target.value)">
                                        @foreach (['A', 'B','C', 'D','E', 'F','G', 'H','I', 'J','K', 'L','M', 'N','O', 'P','Q', 'R','S', 'T','U', 'V','W', 'X','Y', 'X'] as $alpabet)
                                            @if ($item->loket == $alpabet)
                                                <option value="{{$alpabet}}" selected>{{$alpabet}}</option>
                                            @else
                                                <option value="{{$alpabet}}">{{$alpabet}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
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
@endpush
