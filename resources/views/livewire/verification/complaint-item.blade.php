@section('title', 'Pengaduan Pengguna Layanan')

<div>
    {{-- Header --}}
    <div class="mb-8">
        @include('components.page.page-title', ['title' => 'Verifikasi Pengaduan Layanan Dari ' . $complaint->nama_konsumen])
    </div>

    <section>
        <div class="h-full">
            <!-- Table -->
            <div class="w-full mx-auto bg-white border-gray-200 shadow-sm rounded-md">
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td width="25%" class="pl-5 py-6 whitespace-nowrap font-semibold">Tanggal Layanan</td>
                                    <td width="1%" class="font-semibold">:</td>
                                    <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Nama</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Email</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Nomor Whatsapp / Telepon</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Nama Petugas</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->petugas->nama ?? '-' }}</td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Rating Petugas</td>
                                    <td class="font-semibold">:</td>
                                    <td class="flex py-4">
                                        @if (!is_null($complaint->rating_petugas))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $complaint->rating_petugas)
                                                    <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                        @include('components.icon', ['name' => 'star-solid', 'size' => 'w-5 h-5'])
                                                    </span>
                                                @else
                                                    <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                        @include('components.icon', ['name' => 'star-outline', 'size' => 'w-5 h-5'])
                                                    </span>
                                                @endif
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Jenis Layanan</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->layanan->nama_layanan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Rating Layanan</td>
                                    <td class="font-semibold">:</td>
                                    <td class="flex py-4">
                                        @if (!is_null($complaint->rating_layanan))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $complaint->rating_layanan)
                                                    <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                        @include('components.icon', ['name' => 'star-solid', 'size' => 'w-5 h-5'])
                                                    </span>
                                                @else
                                                    <span class="text-secondary-400 {{ $i == 0 ?: 'ml-2' }}">
                                                        @include('components.icon', ['name' => 'star-outline', 'size' => 'w-5 h-5'])
                                                    </span>
                                                @endif
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Kategori Saran Pengaduan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        @if (!is_null($complaint->kode_saran))
                                            @if (count($complaint->kode_saran) > 1)
                                                <ul class="ml-td">
                                                @for($i = 0; $i < count($complaint->kode_saran); $i++)
                                                    <li>{{ \App\Models\m_saran::where('kode_saran', collect($complaint->kode_saran)->get($i))->pluck('nama_saran')[0] }}</li>
                                                @endfor
                                                </ul>
                                            @else
                                                {{ \App\Models\m_saran::where('kode_saran', collect($complaint->kode_saran))->pluck('nama_saran')[0] }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Saran Pengaduan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        <p>{{ $complaint->saran_pengaduan ?? '-' }}</p>
                                    </td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Tanggal Notifikasi</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->tanggal_notifikasi ? $complaint->tanggal_notifikasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Tanggal Kategorisasi</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->tanggal_kategorisasi ? $complaint->tanggal_kategorisasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Tanggal Tindak Lanjut PJ Pelayanan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->tanggal_tl_pj_layanan ? $complaint->tanggal_tl_pj_layanan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Komentar PJ Pelayanan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->text_pj_layanan ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Tanggal Tindak Lanjut PJ Pengaduan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->tanggal_tl_pj_pengaduan ? $complaint->tanggal_tl_pj_pengaduan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-6 whitespace-nowrap font-semibold">Komentar PJ Pengaduan</td>
                                    <td class="font-semibold">:</td>
                                    <td>
                                        {{ $complaint->text_pj_pengaduan ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
