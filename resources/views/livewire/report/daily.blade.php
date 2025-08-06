<div>
    <div class="flex flex-no-wrap justify-between">
        <x-page.page-title title="Laporan Harian" />

        {{-- Reset Tampilan --}}
        <button wire:click="resetData" type="button"
            class="flex items-center p-3 ml-6 text-white rounded-md bg-primary-400 hover:bg-primary-500">
            <x-icons.hero name="arrow-path" size="w-5 h-5" />
            <span class="ml-2 text-sm">Reset Tabel</span>
        </button>
    </div>

    <section class="mt-10 mb-6">
        <div class="w-full overflow-x-auto bg-white rounded-md shadow">
            <div class="flex flex-wrap items-center justify-between p-4">
                <div class="flex justify-start space-x-4 flex-nowrap">
                    <div>
                        <label for="selectedMonth_id"
                            class="text-sm font-bold tracking-wider text-primary-400">Bulan</label>
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
                        <label for="selectedYear_id"
                            class="text-sm font-bold tracking-wider text-primary-400">Tahun</label>
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
                <div class="flex justify-center w-full p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-full border-t sm:w-1/2 md:w-1/3">
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-base font-light table-auto">
                        <thead>
                            <tr class="font-bold text-left bg-neutral-100">
                                <th class="px-6 pt-6 pb-4 text-nowrap">Tanggal</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Pengguna Layanan</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Saran Pengaduan</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Nama Layanan</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Nama Petugas</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Catatan</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Kategori</th>
                                <th class="px-6 pt-6 pb-4 text-nowrap">Selesai Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dailyReport as $report)
                                <tr wire:key="{{ $report->id }}"
                                    class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                    <td class="border-t">
                                        <span class="items-center py-4 pl-6">
                                            {{ $report->created_at->format('d/m/Y') }}
                                        </span>
                                    </td>

                                    {{-- Informasi Pengguna Layanan --}}
                                    <td class="border-t">
                                        <div class="py-4 pl-6">
                                            <div class="text-md">{{ ucwords(strtolower($report->nama_konsumen)) }}
                                            </div>
                                            <div class="mb-2 text-xs text-neutral-500">{{ $report->email_konsumen }}
                                            </div>
                                            <div class="text-xs text-primary-500">{{ $report->no_wa_telepon ?? '-' }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Saran Pengaduan --}}
                                    <td class="border-t" class="w-25">
                                        <div class="py-4 pl-6">
                                            {!! $report->saran_pengaduan !!}
                                        </div>
                                    </td>

                                    {{-- Nama dan Rating Layanan --}}
                                    <td class="border-t">
                                        <div class="py-4 pl-6">
                                            <div class="mb-2">{{ $report->layanan->nama_layanan }}</div>
                                            <div class="flex flex-nowrap">
                                                @if (!is_null($report->rating_layanan))
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $report->rating_layanan)
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                <x-icons.hero name="star-solid" size="w-4 h-4" />
                                                            </span>
                                                        @else
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                <x-icons.hero name="star-outline" size="w-4 h-4" />
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
                                            <div class="flex flex-nowrap">
                                                @if (!is_null($report->rating_petugas))
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $report->rating_petugas)
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                <x-icons.hero name="star-solid" size="w-4 h-4" />
                                                            </span>
                                                        @else
                                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                                <x-icons.hero name="star-outline" size="w-4 h-4" />
                                                            </span>
                                                        @endif
                                                    @endfor
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="border-t">
                                        <div class="py-4 pl-6">
                                            {{ $report->catatan }}
                                        </div>
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="border-t">
                                        <div class="py-4 pl-6">
                                            @if (!is_null($report->kode_saran))
                                                @for ($i = 0; $i < count($report->kode_saran); $i++)
                                                    <div
                                                        class="relative mb-0.5 inline-block px-3 py-1 text-sm leading-tight text-green-900">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 rounded-full opacity-50"></span>
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
                                            <i class="text-sm opacity-50 fas fa-calendar"></i>
                                            {{ $report->tanggal_selesai->format('d/m/Y') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>

    {{ $dailyReport->links('vendor.livewire.tailwind') }}
</div>
