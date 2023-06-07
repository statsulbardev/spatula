@section('title', 'Verifikasi PJ Pengaduan')

<div>
    @include('components.notification.flash')

    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Verifikasi PJ Pengaduan'])

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
            @if ($complaints->isEmpty())
                <img src="{{ asset('files/404.svg') }}"
                     class="w-full border-t">
            @else
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-neutral-100 text-left font-bold">
                            <th class="px-6 pb-4 pt-6">
                                <input type="checkbox"
                                       class="h-5 w-5"
                                       wire:model="selectAll">
                            </th>
                            <th class="px-6 pb-4 pt-6">Tanggal</th>
                            <th class="px-6 pb-4 pt-6">Pengguna Layanan</th>
                            <th class="px-6 pb-4 pt-6">Saran dan Pengaduan</th>
                            <th class="px-6 pb-4 pt-6">Kategori</th>
                            <th class="px-6 pb-4 pt-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints as $complaint)
                            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200">
                                <td class="w-2 border-t px-6 py-4">
                                    <input type="checkbox"
                                           class="h-5 w-5"
                                           wire:model="selectProduct"
                                           value="{{ $complaint->id }}">
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
                                <td class="border-t"
                                    width="45%">
                                    <div x-data="{ isCollapsed: false, maxLength: 120, originalContent: '', content: '' }"
                                         x-init="originalContent = @js($complaint->saran_pengaduan).trim();
                                         content = originalContent.slice(0, maxLength)"
                                         class="flex flex-wrap">
                                        <span x-html="isCollapsed ? originalContent : content"
                                              class="py-4 pl-6 leading-tight">
                                        </span>
                                        <button @click="isCollapsed = !isCollapsed"
                                                x-show="originalContent.length > maxLength"
                                                x-text="isCollapsed ? 'Sedikit' : 'Lebih Banyak'"
                                                class="mb-4 ml-6 rounded-md bg-violet-200 p-2 text-sm text-violet-900 hover:bg-violet-300">
                                        </button>
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="border-t">
                                    <div class="py-4 pl-6">
                                        @if (!is_null($complaint->kode_saran))
                                            @for ($i = 0; $i < count($complaint->kode_saran); $i++)
                                                <div class="relative inline-block px-3 py-1 text-sm leading-tight text-green-900">
                                                    <span aria-hidden class="absolute inset-0 rounded-full bg-green-200 opacity-50"></span>
                                                    <span class="relative">{{ array_column($this->suggestions, $complaint->kode_saran[$i])[0] }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            <span
                                                  class="relative inline-block px-3 py-1 text-sm leading-tight text-red-900">
                                                <span aria-hidden
                                                      class="absolute inset-0 rounded-full bg-red-200 opacity-50"></span>
                                                <span class="relative">Belum Dikategorisasi</span>
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="w-px border-t">
                                    <div class="mr-2 flex items-center space-x-2 py-2">
                                        <a x-data
                                           x-tooltip.raw="Lihat Informasi"
                                           class="cursor-pointer text-primary-400 hover:text-primary-500"
                                           href="{{ url(env('APP_URL') . '/verifikasi/pj-pengaduan/' . $complaint->id) }}">
                                            @include('components.icon', [
                                                'name' => 'eye',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </a>
                                        <button x-data
                                                x-tooltip.raw="Kirim Pesan"
                                                class="text-secondary-400 hover:text-secondary-500">
                                            @include('components.icon', [
                                                'name' => 'message',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </button>
                                        @if (!is_null($complaint->kode_saran))
                                            <button wire:click="finalize({{ $complaint->id }})"
                                                    x-data
                                                    x-tooltip.raw="Selesaikan Verifikasi"
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

@push('scripts')
    @if (session()->has('messages'))
        <script>
            window.onload = function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: '{{ session('messages') }}'
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
