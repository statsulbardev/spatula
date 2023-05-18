@section('title', 'Selesai Tindak Lanjut')

<div>
    <div class="mb-8">
        @include('components.page.page-title', ['title' => 'Selesai Tindak Lanjut'])
    </div>

    <section class="flex mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between items-center">
                <div class="flex flex-no-wrap border rounded">
                    <div class="px-2 md:px-2 rounded-l border-r hover:bg-gray-100 focus:border-white focus:shadow-outline focus:z-10" x-data="{ open: false }">
                        <div class="flex py-3 items-center cursor-pointer" @click="open = true">
                            <span class="text-gray-600 text-sm hidden md:inline">FILTER</span>
                            <svg class="w-2 h-2 fill-gray-600 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                                <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
                            </svg>
                        </div>
                        <div style="position: fixed; top: 0; right: 0; left: 0; bottom: 0; z-index: 99998; background: black; opacity: .2" x-show="open"></div>
                        <div class="mt-6 -ml-6 px-4 py-6 w-screen shadow-xl bg-white rounded" style="position: absolute; z-index: 99999; max-width: 300px" x-show="open" @click.away="open = false">
                            <label class="mt-4 block text-grey-darkest">Dihapus:</label>
                            <select wire:model="trashed" class="mt-1 w-full form-select">
                                <option :value="null"></option>
                                <option value="with">Semua (Termasuk yang Dihapus)</option>
                                <option value="only">Hanya yang Terhapus</option>
                            </select>
                        </div>
                    </div>
                    <input wire:model="search" class="relative w-full px-4 rounded-r focus:shadow-outline text-sm" type="text" placeholder="Cari …" />
                </div>

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
            </div>
            @if($dones->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left font-bold bg-neutral-100">
                            <th class="px-6 pt-6 pb-4">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pt-6 pb-4">Tanggal</th>
                            <th class="px-6 pt-6 pb-4">Pengguna Layanan</th>
                            <th class="px-6 pt-6 pb-4">Saran dan Pengaduan</th>
                            <th class="px-6 pt-6 pb-4">Kategori</th>
                            <th class="px-6 pt-6 pb-4">Tanggal Selesai</th>
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dones as $done)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $done->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <span>
                                            {{ $done->created_at->format('d/m/Y') }}
                                        </span>
                                        {{-- @if ($product->deleted_at)
                                            <div class="flex-no-shrink w-4 h-4 fill-red-600 ml-2">
                                                @include('components.icon', ['name' => 'trash'])
                                            </div>
                                        @endif --}}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ ucwords(strtolower($done->nama_konsumen)) }}
                                    </span>
                                </td>
                                <td class="border-t" width="45%">
                                    <span
                                        x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }"
                                        x-init="originalContent = @js($done->saran_pengaduan).trim(); content = originalContent.slice(0, maxLength)"
                                        class="flex flex-wrap">
                                        <span
                                            x-text="isCollapsed ? originalContent : content"
                                            class="pl-6 py-4 leading-tight">
                                            {!! $done->saran_pengaduan !!}
                                        </span>
                                        <button
                                            @click="isCollapsed = !isCollapsed"
                                            x-show="originalContent.length > maxLength"
                                            x-text="isCollapsed ? 'sedikit' : 'lebih banyak'"
                                            class="ml-6 mb-4 p-2 bg-violet-200 hover:bg-violet-300 rounded-md text-sm">
                                        </button>
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        @if(!is_null($done->kode_saran))
                                            @for($i = 0; $i < count($done->kode_saran); $i++)
                                                <div class="{{ $i == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{ \App\Models\m_saran::where('kode_saran', collect($done->kode_saran)->get($i))->pluck('nama_saran')[0] }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            <span class="relative inline-block px-3 py-1 text-sm text-red-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Belum Dikategorisasi</span>
                                            </span>
                                        @endif
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        {{ $done->tanggal_selesai->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2">
                                        <a
                                            x-data
                                            x-tooltip.raw="Lihat Informasi"
                                            href="{{ url(env('APP_URL'). '/verifikasi/selesai/' . $done->id) }}"
                                            class="text-primary-400 hover:text-primary-500 cursor-pointer">
                                            @include('components.icon', ['name' => 'eye', 'size' => 'w-5 h-5'])
                                        </a>
                                    </span>
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
