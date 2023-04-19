@section('title', 'Pengaduan Pengguna Layanan')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => $complaint->nama_konsumen])

    <section>
        <div class="h-full">
            <!-- Table -->
            <div class="w-full mx-auto bg-white border-gray-200 shadow-sm rounded-md">
                <header class="pl-3 py-4 border-b border-gray-100">
                    <span class="pl-5 font-bold text-primary-500 text-lg">Informasi Pengguna Layanan</span>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td width="25%" class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Layanan</td>
                                    <td width="1%" class="text-md font-medium">:</td>
                                    <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nama</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $complaint->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Email</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $complaint->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nomor Whatsapp / Telepon</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $complaint->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nama Petugas</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $complaint->petugas->nama ?? '-' }}</td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Rating Petugas</td>
                                    <td class="text-md font-medium">:</td>
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
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Jenis Layanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $complaint->layanan->nama_layanan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Rating Layanan</td>
                                    <td class="text-md font-medium">:</td>
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
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Kategori Saran Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
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
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Saran Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        <p>{{ $complaint->saran_pengaduan ?? '-' }}</p>
                                    </td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Notifikasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $complaint->tanggal_notifikasi ? $complaint->tanggal_notifikasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Kategorisasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $complaint->tanggal_kategorisasi ? $complaint->tanggal_kategorisasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Tindak Lanjut PJ Pelayanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $complaint->tanggal_tl_pj_layanan ? $complaint->tanggal_tl_pj_layanan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Komentar PJ Pelayanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $complaint->text_pj_layanan ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Tindak Lanjut PJ Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $complaint->tanggal_tl_pj_pengaduan ? $complaint->tanggal_tl_pj_pengaduan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Komentar PJ Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
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
