@section('title', 'Pengguna Layanan')

<div>
    {{-- Breadcrumb --}}
    <div class="mx-auto mb-8">
        @include('partials.breadcrumb', [
            'routeLevelOne' => route('daftar-selesai'),
            'levelOne'      => 'Daftar Selesai',
            'routeLevelTwo' => route('detail-selesai', ['customer' => $done->id]),
            'levelTwo'      => 'Item Selesai',
            'levelThree'    => $done->nama_konsumen
        ])
    </div>

    {{-- Informasi Pengguna Layanan --}}
    <section>
        <div class="h-full">
            <!-- Table -->
            <div class="w-full mx-auto bg-white border-gray-200 shadow-sm rounded-md">
                <header class="pl-3 py-4 border-b border-gray-100">
                    <span class="pl-5 font-bold text-primary-500 text-lg">Informasi Hasil Verifikasi</span>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td width="25%" class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Layanan</td>
                                    <td width="1%" class="text-md font-medium">:</td>
                                    <td>{{ $done->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nama</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $done->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Email</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $done->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nomor Whatsapp / Telepon</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $done->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nama Petugas</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $done->petugas->nama ?? '-' }}</td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Rating Petugas</td>
                                    <td class="text-md font-medium">:</td>
                                    <td class="flex py-4">
                                        @if (!is_null($done->rating_petugas))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $done->rating_petugas)
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
                                    <td>{{ $done->layanan->nama_layanan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Rating Layanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td class="flex py-4">
                                        @if (!is_null($done->rating_layanan))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $done->rating_layanan)
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
                                        @if (!is_null($done->kode_saran))
                                            @if (count($done->kode_saran) > 1)
                                                <ul class="ml-td">
                                                @for($i = 0; $i < count($done->kode_saran); $i++)
                                                    <li>{{ \App\Models\m_saran::where('kode_saran', collect($done->kode_saran)->get($i))->pluck('nama_saran')[0] }}</li>
                                                @endfor
                                                </ul>
                                            @else
                                                {{ \App\Models\m_saran::where('kode_saran', collect($done->kode_saran))->pluck('nama_saran')[0] }}
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
                                        <p>{{ $done->saran_pengaduan ?? '-' }}</p>
                                    </td>
                                </div>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Notifikasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->tanggal_notifikasi ? $done->tanggal_notifikasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Kategorisasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->tanggal_kategorisasi ? $done->tanggal_kategorisasi->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Tindak Lanjut PJ Pelayanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->tanggal_tl_pj_layanan ? $done->tanggal_tl_pj_layanan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Komentar PJ Pelayanan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->text_pj_layanan ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Tindak Lanjut PJ Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->tanggal_tl_pj_pengaduan ? $done->tanggal_tl_pj_pengaduan->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Komentar PJ Pengaduan</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->text_pj_pengaduan ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Tanggal Selesai Tindak Lanjut</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>
                                        {{ $done->tanggal_selesai->format('d/m/Y') }}
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
