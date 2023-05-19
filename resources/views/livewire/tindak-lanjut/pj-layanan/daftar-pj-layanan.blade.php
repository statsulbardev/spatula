@section('title', 'Verifikasi PJ Layanan')

<div>
    @include('components.notification.flash')

    <div class="mb-8">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Verifikasi PJ Layanan'])
    </div>

    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="p-4 flex flex-wrap justify-between">
                {{-- Pencarian --}}
                @include('components.input.search')

                {{-- Pagination Filter --}}
                @include('components.input.pagination-selected')
            </div>
            @if($services->isEmpty())
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
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                <td class="border-t px-6 py-4 w-2">
                                    <input type="checkbox" class="h-5 w-5" wire:model="selectProduct" value="{{ $service->id }}">
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4 items-center">
                                        <i class="fas fa-calendar opacity-50 text-sm"></i> {{ $service->created_at->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        {{ ucwords(strtolower($service->nama_konsumen)) }}
                                    </span>
                                </td>
                                <td class="border-t" width="50%">
                                    <span
                                        x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }"
                                        x-init="originalContent = @js($service->saran_pengaduan).trim(); content = originalContent.slice(0, maxLength)"
                                        class="flex flex-wrap">
                                        <span
                                            x-text="isCollapsed ? originalContent : content"
                                            class="pl-6 py-4 leading-tight">
                                            {!! $service->saran_pengaduan !!}
                                        </span>
                                        <button
                                            @click="isCollapsed = !isCollapsed"
                                            x-show="originalContent.length > maxLength"
                                            x-text="isCollapsed ? 'Sedikit' : 'Lebih Banyak'"
                                            class="ml-6 mb-4 p-2 bg-violet-200 hover:bg-violet-300 text-violet-900 rounded-md text-sm">
                                        </button>
                                    </span>
                                </td>
                                <td class="border-t">
                                    <span class="pl-6 py-4">
                                        <span>
                                            @if(!is_null($service->kode_saran))
                                                @for($i = 0; $i < count($service->kode_saran); $i++)
                                                    <div class="{{ $i == 0 ?: 'ml-1' }} relative inline-block px-3 py-1 text-sm text-green-900 leading-tight">
                                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">{{ \App\Models\m_saran::where('kode_saran', collect($service->kode_saran)->get($i))->pluck('nama_saran')[0] }}</span>
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
                                <td class="border-t w-px">
                                    <span class="py-2 flex items-center space-x-2 mr-2">
                                        @if(!is_null($service->kode_saran))
                                            <a
                                                x-data
                                                x-tooltip.raw="Edit Kategori"
                                                class="text-purple-400 hover:text-purple-500"
                                                href="{{ url(env('APP_URL') . '/verifikasi/pj-layanan/kategorisasi/' . $service->id) . '/edit' }}">
                                                @include('components.icon', ['name' => 'pencil-square', 'size' => 'w-5 h-5'])
                                            </a>
                                        @else
                                            <a
                                                x-data
                                                x-tooltip.raw="Verifikasi"
                                                class="text-cyan-400 hover:text-cyan-500"
                                                href="{{ url(env('APP_URL') . '/verifikasi/pj-layanan/kategorisasi/' . $service->id) }}">
                                                @include('components.icon', ['name' => 'tag', 'size' => 'w-5 h-5'])
                                            </a>
                                        @endif
                                        <button
                                            x-data
                                            x-tooltip.raw="Kirim Pesan"
                                            class="text-secondary-400 hover:text-secondary-500">
                                            @include('components.icon', ['name' => 'message', 'size' => 'w-5 h-5'])
                                        </button>
                                        <button
                                            wire:click="deleteItem({{ $service->id }})"
                                            type="button"
                                            x-data
                                            x-tooltip.raw="Hapus Penilaian"
                                            class="text-red-500 hover:text-red-600"
                                            data-te-toggle="modal"
                                            data-te-target="#deleteModal"
                                            data-te-ripple-init
                                            data-te-ripple-color="light">
                                            @include('components.icon', ['name' => 'trash', 'size' => 'w-5 h-5'])
                                        </button>
                                        @if(!is_null($service->kode_saran))
                                            <button
                                                wire:click="finalizeServiceItem({{ $service->id }})"
                                                x-data
                                                x-tooltip.raw="Selesaikan Verifikasi"
                                                class="text-green-400 hover:text-green-500">
                                                @include('components.icon', ['name' => 'check-circle', 'size' => 'w-5 h-5'])
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
    {{ $services->links('vendor.livewire.tailwind') }}

    {{-- Delete Confirmation Modal --}}
    @include('components.input.delete-confirmation')
</div>

@push('scripts')
    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session("messages") }}'
                }));
            }
        </script>
    @endif
    <script>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>
@endpush
