@section('title', 'Laporan Harian')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Laporan Harian'])

    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded-md shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap items-center justify-between">
                <div class="flex flex-wrap">
                    <div wire:ignore>
                        <select wire:model.defer="selectedMonth" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                            <option value="null" hidden selected>Pilih Bulan...</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <label data-te-select-label-ref>Bulan</label>
                    </div>
                    <div wire:ignore class="ml-4">
                        <select wire:model="selectedYear" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                            <option value="null" hidden selected>Pilih Tahun...</option>
                            @foreach ($years as $yearItem)
                                <option value="{{ $yearItem }}">{{ $yearItem }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Tahun</label>
                    </div>
                </div>
                <button wire:click="resetData" class="btn-primary">
                    @include('components.icon', ['name' => 'arrow-path', 'size' => 'w-5 h-5'])
                </button>
            </div>
            @if($dailyReport->count() === 0)
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">Tanggal</th>
                            <th class="px-6 pt-6 pb-4">Nama Petugas</th>
                            <th class="px-6 pt-6 pb-4">Rating Petugas</th>
                            <th class="px-6 pt-6 pb-4">Jenis Layanan</th>
                            <th class="px-6 pt-6 pb-4">Rating Layanan</th>
                            <th class="px-6 pt-6 pb-4">Pengguna Layanan</th>
                            <th class="px-6 pt-6 pb-4">Saran dan Pengaduan</th>
                            <th class="px-6 pt-6 pb-4">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyReport->paginate(20) as $report)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i> {{ $report->created_at->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $report->petugas->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 flex items-center">
                                        @if (!is_null($report->rating_petugas))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $report->rating_petugas)
                                                    <i class="fas fa-star text-secondary-400"></i>
                                                @else
                                                    <i class="far fa-star text-secondary-400"></i>
                                                @endif
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $report->layanan->nama_layanan }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < $report->rating_layanan)
                                                <i class="fas fa-star text-secondary-400"></i>
                                            @else
                                                <i class="far fa-star text-secondary-400"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $report->nama_konsumen }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ Str::limit($report->saran_pengaduan, 50) }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        @if(!is_null($report->kode_saran))
                                            @for($i = 0; $i < count($report->kode_saran); $i++)
                                                <div class="relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{ \App\Models\m_saran::where('kode_saran', collect($report->kode_saran)->get($i))->pluck('nama_saran')[0] }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
    {{ $dailyReport->paginate(20)->links('vendor.spatula') }}
</div>
