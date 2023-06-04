@section('title', 'Laporan Harian')

<div>

    <div class="flex flex-no-wrap justify-between">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Laporan Harian'])

        {{-- Reset Tampilan --}}
        <button wire:click="resetData" type="button"
            class="ml-6 p-3 text-white bg-primary-400 hover:bg-primary-500 rounded-md flex items-center">
            @include('components.icon', ['name' => 'cursor-arrow-ripple', 'size' => 'w-5 h-5'])
            <span class="ml-2 text-sm">Reset Tabel</span>
        </button>
    </div>

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded-md shadow">
            <div class="p-4 flex flex-wrap items-center justify-between">
                <div class="flex flex-wrap">
                    <div wire:ignore>
                        <select wire:model.defer="selectedMonth" data-te-select-init data-te-select-filter="true"
                            data-te-select-size="lg">
                            <option hidden selected>Pilih Bulan...</option>
                            @foreach ($this->months as $month)
                                <option value="{{ $month[0] }}">{{ $month[1] }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Bulan</label>
                    </div>
                    <div wire:ignore class="ml-4">
                        <select wire:model="selectedYear" data-te-select-init data-te-select-filter="true"
                            data-te-select-size="lg">
                            <option hidden selected>Pilih Tahun...</option>
                            @foreach ($this->years as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Tahun</label>
                    </div>
                </div>

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
            </div>
            @if ($dailyReport->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">Tanggal</th>
                            <th class="px-6 pt-6 pb-4">Pengguna Layanan</th>
                            <th class="px-6 pt-6 pb-4">Saran Pengaduan</th>
                            <th class="px-6 pt-6 pb-4">Nama Layanan</th>
                            <th class="px-6 pt-6 pb-4">Nama Petugas</th>
                            <th class="px-6 pt-6 pb-4">Kategori</th>
                            <th class="px-6 pt-6 pb-4">Selesai Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyReport as $report)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i>
                                        {{ $report->created_at->format('d/m/Y') }}
                                    </span>
                                </td>

                                {{-- Informasi Pengguna Layanan --}}
                                <td class="border-t">
                                    <div class="pl-6 py-4">
                                        <div class="text-md">{{ ucwords(strtolower($report->nama_konsumen)) }}</div>
                                        <div class="mb-2 text-sm text-neutral-500">{{ $report->email_konsumen }}</div>
                                        <div class="text-sm text-primary-500">{{ $report->no_wa_telepon ?? '-' }}</div>
                                    </div>
                                </td>

                                {{-- Saran Pengaduan --}}
                                <td class="border-t" width="35%">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }" x-init="originalContent = @js($report->saran_pengaduan).trim();
                                    content = originalContent.slice(0, maxLength)" class="flex flex-wrap">

                                        <span x-html="isCollapsed ? originalContent : content"
                                            class="pl-6 py-4 leading-tight">
                                        </span>

                                        <button @click="isCollapsed = !isCollapsed"
                                            x-show="originalContent.length > maxLength"
                                            x-text="isCollapsed ? 'Sedikit' : 'Lebih Banyak'"
                                            class="ml-6 mb-4 p-2 bg-violet-200 hover:bg-violet-300 text-violet-900 rounded-md text-sm">
                                        </button>
                                    </div>
                                </td>

                                {{-- Nama dan Rating Layanan --}}
                                <td class="border-t">
                                    <div class="pl-6 py-4">
                                        <div class="mb-2">{{ $report->layanan->nama_layanan }}</div>
                                        <div class="flex">
                                            @if (!is_null($report->rating_layanan))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $report->rating_layanan)
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', [
                                                                'name' => 'star-solid',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @else
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', [
                                                                'name' => 'star-outline',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @endif
                                                @endfor
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Nama dan Rating Petugas --}}
                                <td class="border-t">
                                    <div class="pl-6 py-4">
                                        <div class="mb-2">{{ $report->petugas->nama ?? '-' }}</div>
                                        <div class="flex">
                                            @if (!is_null($report->rating_petugas))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $report->rating_petugas)
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', [
                                                                'name' => 'star-solid',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @else
                                                        <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                            @include('components.icon', [
                                                                'name' => 'star-outline',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @endif
                                                @endfor
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        @if (!is_null($report->kode_saran))
                                            @for ($i = 0; $i < count($report->kode_saran); $i++)
                                                <div
                                                    class="relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                    <span aria-hidden
                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span
                                                        class="relative">{{ \App\Models\m_saran::where('kode_saran', collect($report->kode_saran)->get($i))->pluck('nama_saran')[0] }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </span>
                                </td>

                                {{-- Tanggal Selesai Verifikasi --}}
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i>
                                        {{ $report->tanggal_selesai->format('d/m/Y') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
    {{ $dailyReport->links('vendor.livewire.tailwind') }}
</div>
