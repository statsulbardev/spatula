@section('title', 'Selesai Tindak Lanjut')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Daftar Hasil Verifikasi'])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    <section class="mb-6 mt-10 flex">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                {{-- Pencarian --}}
                @include('components.input.search')

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
            </div>
            @if ($dones->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Tanggal</th>
                            <th class="px-6 pb-4 pt-6">Pengguna Layanan</th>
                            <th class="px-6 pb-4 pt-6">Saran dan Pengaduan</th>
                            <th class="px-6 pb-4 pt-6">Kategori</th>
                            <th class="px-6 pb-4 pt-6">Tanggal Selesai</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dones as $done)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $done->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
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
                                {{-- Pengguna Layanan, Email, dan WA --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        <div class="text-md">{{ ucwords(strtolower($done->nama_konsumen)) }}</div>
                                        <div class="mb-2 text-sm text-neutral-500">{{ $done->email_konsumen }}</div>
                                        <div class="text-sm text-primary-500">{{ $done->no_wa_telepon ?? '-' }}</div>
                                    </div>
                                </td>

                               {{-- Saran Pengaduan --}}
                                <td class="border-t" width="35%">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }" x-init="originalContent = @js($done->saran_pengaduan).trim();
                                        content = originalContent.slice(0, maxLength)" class="flex flex-wrap">

                                        <span x-html="isCollapsed ? originalContent : content" class="py-4 pl-6 leading-tight">
                                        </span>

                                        <button @click="isCollapsed = !isCollapsed" x-show="originalContent.length > maxLength"
                                            x-text="isCollapsed ? 'Sedikit' : 'Lebih Banyak'"
                                            class="mb-4 ml-6 rounded-md bg-violet-200 p-2 text-sm text-violet-900 hover:bg-violet-300">
                                        </button>
                                    </div>
                                </td>
                                <td class="border-t">
                                    <span class="py-4 pl-6">
                                        @if (!is_null($done->kode_saran))
                                            @for ($i = 0; $i < count($done->kode_saran); $i++)
                                                <div
                                                    class="{{ $i == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm leading-tight text-green-900">
                                                    <span aria-hidden class="absolute inset-0 rounded-full bg-green-200 opacity-50"></span>
                                                    <span class="relative">
                                                        {{ array_column($this->suggestions, $done->kode_saran[$i])[0] }}
                                                        {{-- {{ \App\Models\m_saran::where('kode_saran',
                                            collect($done->kode_saran)->get($i))->pluck('nama_saran')[0] }} --}}
                                                    </span>
                                                </div>
                                            @endfor
                                        @else
                                            <span class="relative inline-block px-3 py-1 text-sm leading-tight text-red-900">
                                                <span aria-hidden class="absolute inset-0 rounded-full bg-red-200 opacity-50"></span>
                                                <span class="relative">Belum Dikategorisasi</span>
                                            </span>
                                        @endif
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="items-center py-4 pl-6">
                                        {{ $done->tanggal_selesai->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="w-px border-t">
                                    <span class="mr-2 flex items-center space-x-2 py-2">
                                        <a x-data x-tooltip.raw="Lihat Informasi"
                                            href="{{ url(env('APP_URL') . '/verifikasi/selesai/' . $done->id) }}"
                                            class="cursor-pointer text-primary-400 hover:text-primary-500">
                                            @include('components.icon', [
                                                'name' => 'eye',
                                                'size' => 'w-5 h-5',
                                            ])
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
