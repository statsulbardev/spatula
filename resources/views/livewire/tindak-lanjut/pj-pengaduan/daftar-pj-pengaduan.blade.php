@section('title', 'Konfirmasi PJ Pengaduan')

<div>
    <h1 class="mb-8 font-bold text-3xl">Konfirmasi PJ Pengaduan</h1>

    <section class="flex mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap items-center">
                <div class="w-1/3">
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
                </div>
                <div class="w-2/3 flex items-center" x-data="{ dialog: false }">
                    <span class="w-full"></span>

                    {{-- Menghapus Informasi --}}
                    <a class="text-gray-700 bg-white hover:bg-gray-100 border mr-2 p-2 rounded cursor-pointer flex items-center" @click="dialog = true">
                        <i class="fas fa-trash text-red-600"></i>
                    </a>

                    {{-- delete confirmation dialog --}}
                    {{-- @include('components.dialog.delete', ['title' => 'Hapus Informasi Perangkat IT']) --}}
                </div>
            </div>
            @if($complaints->count() === 0)
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
                            <th class="px-6 pt-6 pb-4">Tanggal Kategorisasi</th>
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints->paginate(20) as $complaint)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $complaint->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i> {{ DateFormat::convertDateTime($complaint->created_at) }}
                                        {{-- @if ($product->deleted_at)
                                            <div class="flex-no-shrink w-4 h-4 fill-red-600 ml-2">
                                                @include('components.icon', ['name' => 'trash'])
                                            </div>
                                        @endif --}}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ $complaint->nama_konsumen }}
                                    </span>
                                </td>
                                <td class="border-t" width="45%">
                                    <span class="pl-6 py-4 flex items-center">
                                        {{ Str::limit($complaint->saran_pengaduan, 100) }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        <span>
                                            @if(!is_null($complaint->kode_saran))
                                                @for($i = 0; $i < count($complaint->kode_saran); $i++)
                                                    <div class="relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">{{ \App\Models\m_saran::where('kode_saran', collect($complaint->kode_saran)->get($i))->pluck('nama_saran')[0] }}</span>
                                                    </div>
                                                @endfor
                                            @else
                                                <span class="relative inline-block px-3 py-1 text-sm text-red-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Belum Dikategorisasi</span>
                                                </span>
                                            @endif
                                        </span>
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i> {{ DateFormat::convertDateTime($complaint->tanggal_kategorisasi) }}
                                    </span>
                                </td>
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2">
                                        <button class="border-2 border-secondary-200 rounded-md p-1 hover:border-secondary-500">
                                            <i class="fas fa-envelope text-secondary-400"></i>
                                        </button>
                                        @if(!is_null($complaint->kode_saran))
                                            <button class="border-2 border-primary-200 rounded-md p-1 hover:border-primary-500">
                                                <i class="fas fa-check-circle text-primary-400"></i>
                                            </button>
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
    {{ $complaints->paginate(20)->links('vendor.spatula') }}
</div>
