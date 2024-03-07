@section('title', 'Verifikasi PJ Pengaduan')

<div class="px-4 md:px-6 2xl:px-11 py-8">

    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Verifikasi PJ Pengaduan'])

    {{-- Breadcrumb --}}
    @include('components.partials.breadcrumb')

    <section class="mb-6 mt-10 flex">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                {{-- Pencarian --}}
                @include('components.input.search')

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
            </div>
            @if ($complaints->isEmpty())
                <img src="{{ asset('files/404.svg') }}" class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox" class="h-5 w-5" wire:model.live="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Tanggal</th>
                            <th class="px-6 pb-4 pt-6">Pengguna Layanan</th>
                            <th class="px-6 pb-4 pt-6">Saran dan Pengaduan</th>
                            <th class="px-6 pb-4 pt-6">Nama Layanan</th>
                            <th class="px-6 pb-4 pt-6">Nama Petugas</th>
                            <th class="px-6 pb-4 pt-6">Keterangan</th>
                            <th class="px-6 pb-4 pt-6">Kategori</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints as $complaint)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox" class="h-5 w-5" wire:model.live="selectProduct" value="{{ $complaint->id }}">
                                </td>

                                {{-- Tanggal --}}
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        <i class="fas fa-calendar text-sm opacity-50"></i>
                                        {{ $complaint->created_at->format('d/m/Y') }}
                                    </div>
                                </td>

                                {{-- Pengguna Layanan, Email, WA --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        <div class="text-md">{{ ucwords(strtolower($complaint->nama_konsumen)) }}</div>
                                        <div class="mb-2 text-sm text-neutral-500">{{ $complaint->email_konsumen }}
                                        </div>
                                        <div class="text-sm text-primary-500">{{ $complaint->no_wa_telp ?? '-' }}</div>
                                    </div>
                                </td>

                                {{-- Saran Pengaduan --}}
                                <td class="border-t" width="35%">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }" x-init="originalContent = @js($complaint->saran_pengaduan).trim();
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
                                        <div class="mb-2">{{ $complaint->layanan->nama_layanan }}</div>
                                        <div class="flex flex-nowrap">
                                            @if (!is_null($complaint->rating_layanan))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $complaint->rating_layanan)
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
                                        <div class="mb-2">{{ $complaint->petugas->nama ?? '-' }}</div>
                                        <div class="flex flex-nowrap">
                                            @if (!is_null($complaint->rating_petugas))
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $complaint->rating_petugas)
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

                                {{-- Keterangan --}}
                                <td class="border-t">
                                    <div class="items-center py-4 pl-6">
                                        <i class="fas fa-calendar text-sm opacity-50"></i>
                                        {!! $complaint->catatan ?? '-' !!}
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        @for ($i = 0; $i < count($complaint->kode_saran); $i++)
                                            <div class="mb-1 flex flex-nowrap items-center">
                                                <span class="text-{{ array_column($this->colorSuggestions, $complaint->kode_saran[$i])[0] }}-400">
                                                    @include('components.icon', ['name' => 'tag', 'size' => 'w-4 h-4'])
                                                </span>
                                                <span class="text-{{ array_column($this->colorSuggestions, $complaint->kode_saran[$i])[0] }}-400 ml-1">
                                                    {{ array_column($this->suggestions, $complaint->kode_saran[$i])[0] }}
                                                </span>
                                            </div>
                                        @endfor
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="w-px border-t">
                                    <div class="pl-4 mr-2 flex items-center space-x-2 py-2">
                                        <a x-data x-tooltip.raw="Lihat Informasi"
                                            class="cursor-pointer text-primary-400 hover:text-primary-500"
                                            href="{{ url(env('APP_URL') . '/verifikasi/pj-pengaduan/' . $complaint->id) }}"
                                            wire:navigate>
                                            @include('components.icon', [
                                                'name' => 'eye',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        <button x-data x-tooltip.raw="Kirim Pesan" class="text-secondary-400 hover:text-secondary-500">
                                            @include('components.icon', [
                                                'name' => 'message',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </button>
                                        @if (!is_null($complaint->kode_saran))
                                            <button wire:click="finalize({{ $complaint->id }})" x-data x-tooltip.raw="Selesaikan Verifikasi"
                                                class="text-green-400 hover:text-green-500">
                                                @include('components.icon', [
                                                    'name' => 'check-circle',
                                                    'size' => 'w-5 h-5',
                                                ])
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
    {{ $complaints->links('vendor.livewire.tailwind') }}

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>
