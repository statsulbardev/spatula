<div class="px-4 md:px-6 2xl:px-11 py-8">
    <x-page.page-title title="Daftar Hasil Verifikasi" />

    <section class="mb-6 mt-10 flex">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                <x-forms.inputs.search />

                <x-forms.attributes.pagination-selected />
            </div>
            @if ($dones->isEmpty())
                <div class="w-full flex  justify-center p-5">
                    <img src="{{ asset('public/files/404.svg') }}" class="w-full sm:w-1/2 md:w-1/3 border-t">
                </div>
            @else
                <table class="w-full table-auto overflow-auto text-base font-light">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th scope="col" class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                            </th>
                            <th scope="col" class="px-6 pb-4 pt-6">Tanggal</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Pengguna Layanan</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Saran dan Pengaduan</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Nama Layanan</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Nama Petugas</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Keterangan</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Kategori</th>
                            <th scope="col" class="px-6 pb-4 pt-6">Tanggal Selesai</th>
                            <th scope="col" class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dones as $done)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $done->id }}">
                                </td>

                                {{-- Tanggal Penilaian --}}
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $done->created_at->format('d/m/Y') }}
                                    </div>
                                </td>

                                {{-- Pengguna Layanan, Email, dan WA --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        <div class="text-md">{{ ucwords(strtolower($done->nama_konsumen)) }}</div>
                                        <div class="mb-2 text-xs text-neutral-500">{{ $done->email_konsumen }}</div>
                                        <div class="text-xs text-primary-500">{{ $done->no_wa_telepon ?? '-' }}</div>
                                    </div>
                                </td>

                               {{-- Saran Pengaduan --}}
                                <td class="border-t">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }"
                                        x-init="originalContent = @js($done->saran_pengaduan).trim();
                                        content = originalContent.slice(0, maxLength)" class="flex flex-wrap">

                                        <span x-html="isCollapsed ? originalContent : content"
                                            class="py-4 pl-6 leading-tight">
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
                                        <div class="mb-2">{{ $done->layanan->nama_layanan }}</div>
                                        <div class="flex flex-nowrap">
                                            @if (!is_null($done->rating_layanan))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $done->rating_layanan)
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
                                        <div class="mb-2">{{ $done->petugas->nama ?? '-' }}</div>
                                        <div class="flex flex-nowrap">
                                            @if (!is_null($done->rating_petugas))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $done->rating_petugas)
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

                                {{-- Keterangan --}}
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $done->catatan ?? '-' }}
                                    </div>
                                </td>

                                {{-- Kategorisasi --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        @for ($i = 0; $i < count($done->kode_saran); $i++)
                                            <div class="mb-1 flex flex-nowrap items-center">
                                                <span class="text-{{ array_column($this->colorSuggestions, $done->kode_saran[$i])[0] }}-400">
                                                    <x-icons.hero name="tag-solid" size="w-4 h-4" />
                                                </span>
                                                <span class="text-{{ array_column($this->colorSuggestions, $done->kode_saran[$i])[0] }}-400 font-medium ml-1">
                                                    {{ array_column($this->suggestions, $done->kode_saran[$i])[0] }}
                                                </span>
                                            </div>
                                        @endfor
                                    </div>
                                </td>

                                {{-- Tanggal Selesai Verifikasi --}}
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        {{ $done->tanggal_selesai->format('d/m/Y') }}
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="w-px border-t">
                                    <div class="mr-2 flex items-center space-x-2 py-2">
                                        <a
                                            x-data
                                            x-tooltip.raw="Lihat Informasi"
                                            href="{{ route('detail-selesai', $done->id) }}"
                                            class="cursor-pointer text-primary-400 hover:text-primary-500"
                                            wire:navigate>
                                            <x-icons.hero name="eye-outline" size="w-5 h-5" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

    {{ $dones->links('vendor.livewire.tailwind') }}
</div>
