<div>
    <div class="flex-no-wrap flex justify-between">
        <x-page.page-title title="Laporan Harian" />

        {{-- Reset Tampilan --}}
        <button wire:click="resetData" type="button"
            class="ml-6 flex items-center rounded-md bg-primary-400 p-3 text-white hover:bg-primary-500">
            <x-icons.hero name="arrow-path" size="w-5 h-5" />
            <span class="ml-2 text-sm">Reset Tabel</span>
        </button>
    </div>

    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded-md bg-white shadow">
            <div class="flex flex-wrap items-center justify-between p-4">
                <div class="flex flex-nowrap justify-start space-x-4">
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
                </div>
                {{-- Pagination Filter --}}
                <x-forms.attributes.pagination-selected />
            </div>
            @if ($dailyReport->isEmpty())
                <div class="w-full flex  justify-center p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
                </div>
            @else
                <table class="w-full table-auto overflow-auto text-base font-light">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">Tanggal</th>
                            <th class="px-6 pb-4 pt-6">Pengguna Layanan</th>
                            <th class="px-6 pb-4 pt-6">Saran Pengaduan</th>
                            <th class="px-6 pb-4 pt-6">Nama Layanan</th>
                            <th class="px-6 pb-4 pt-6">Nama Petugas</th>
                            <th class="px-6 pb-4 pt-6">Kategori</th>
                            <th class="px-6 pb-4 pt-6">Selesai Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyReport as $report)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
                                        {{ $report->created_at->format('d/m/Y') }}
                                    </span>
                                </td>

                                {{-- Informasi Pengguna Layanan --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        <div class="text-md">{{ ucwords(strtolower($report->nama_konsumen)) }}</div>
                                        <div class="mb-2 text-xs text-neutral-500">{{ $report->email_konsumen }}</div>
                                        <div class="text-xs text-primary-500">{{ $report->no_wa_telepon ?? '-' }}</div>
                                    </div>
                                </td>

                                {{-- Saran Pengaduan --}}
                                <td class="border-t" width="35%">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }" x-init="originalContent = @js($report->saran_pengaduan).trim();
                                    content = originalContent.slice(0, maxLength)" class="flex flex-wrap">

                                        <span x-html="isCollapsed ? originalContent : content" class="py-4 pl-6 leading-tight">
                                        </span>

                                        <button @click="isCollapsed = !isCollapsed" x-show="originalContent.length > maxLength"
                                            x-text="isCollapsed ? 'less..' : 'more..'"
                                            class="mb-4 ml-6 rounded-md bg-violet-200 p-2 text-sm text-violet-900 hover:bg-violet-300">
                                        </button>
                                    </div>
                                </td>

                                {{-- Nama dan Rating Layanan --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        <div class="mb-2">{{ $report->layanan->nama_layanan }}</div>
                                        <div class="flex">
                                            @if (!is_null($report->rating_layanan))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $report->rating_layanan)
                                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                            @include('components.icon', [
                                                                'name' => 'star-solid',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @else
                                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
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
                                    <div class="py-4 pl-6">
                                        <div class="mb-2">{{ $report->petugas->nama ?? '-' }}</div>
                                        <div class="flex">
                                            @if (!is_null($report->rating_petugas))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $report->rating_petugas)
                                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                            @include('components.icon', [
                                                                'name' => 'star-solid',
                                                                'size' => 'w-4 h-4',
                                                            ])
                                                        </span>
                                                    @else
                                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
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
                                    <div class="py-4 pl-6">
                                        @if (!is_null($report->kode_saran))
                                            @for ($i = 0; $i < count($report->kode_saran); $i++)
                                                <div class="relative inline-block px-3 py-1 text-sm leading-tight text-green-900 mb-0.5">
                                                    <span aria-hidden class="absolute inset-0 rounded-full bg-green-200 opacity-50"></span>
                                                    <span
                                                        class="relative">{{ array_column($this->suggestions, $report->kode_saran[$i])[0] }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>

                                {{-- Tanggal Selesai Verifikasi --}}
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
                                        <i class="fas fa-calendar text-sm opacity-50"></i>
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
