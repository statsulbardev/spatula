<div class="px-4 md:px-6 2xl:px-11 py-8">
    <x-page.page-title title="Hasil Verifikasi {{ $done->nama_konsumen }}" />

    {{-- Informasi Pengguna Layanan --}}
    <section class="mb-6 mt-10">
        <div class="h-full">
            <!-- Table -->
            <div class="mx-auto w-full rounded-md border-gray-200 bg-white shadow-sm">
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td width="25%" class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Layanan
                                    </td>
                                    <td width="1%" class="font-semibold">:</td>
                                    <td>{{ $done->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nama</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $done->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Email</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $done->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nomor Whatsapp / Telepon</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $done->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nama Petugas</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $done->petugas->nama ?? '-' }}</td>
                    </div>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Petugas</td>
                        <td class="font-semibold">:</td>
                        <td class="align-middle">
                            <div class="flex">
                                @if (!is_null($done->rating_petugas))
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $done->rating_petugas)
                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                <x-icons.hero name="star-solid" size="w-5 h-5" />
                                            </span>
                                        @else
                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                            <x-icons.hero name="star-outline" size="w-5 h-5" />
                                        </span>
                                        @endif
                                    @endfor
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Jenis Layanan</td>
                        <td class="font-semibold">:</td>
                        <td>{{ $done->layanan->nama_layanan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Layanan</td>
                        <td class="font-semibold">:</td>
                        <td class="align-middle">
                            <div class="flex">
                                @if (!is_null($done->rating_layanan))
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $done->rating_layanan)
                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                <x-icons.hero name="star-solid" size="w-5 h-5" />
                                            </span>
                                        @else
                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                <x-icons.hero name="star-outline" size="w-5 h-5" />
                                            </span>
                                        @endif
                                    @endfor
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Kategori Saran Pengaduan</td>
                        <td class="font-semibold">:</td>
                        <td>
                            @if (!is_null($done->kode_saran))
                                @if (count($done->kode_saran) > 1)
                                    <ul class="ml-td">
                                        @for ($i = 0; $i < count($done->kode_saran); $i++)
                                            <li>{{ \App\Models\m_saran::where('kode_saran', collect($done->kode_saran)->get($i))->pluck('nama_saran')[0] }}
                                            </li>
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
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Saran Pengaduan</td>
                        <td class="font-semibold">:</td>
                        <td>
                            @if ($done->saran_pengaduan)
                                {!! $done->saran_pengaduan !!}
                            @else
                                -
                            @endif
                        </td>
                </div>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Notifikasi</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->tanggal_notifikasi ? $done->tanggal_notifikasi->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Kategorisasi</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->tanggal_kategorisasi ? $done->tanggal_kategorisasi->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Tindak Lanjut PJ Pelayanan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->tanggal_tl_pj_layanan ? $done->tanggal_tl_pj_layanan->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Komentar PJ Pelayanan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->text_pj_layanan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Tindak Lanjut PJ Pengaduan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->tanggal_tl_pj_pengaduan ? $done->tanggal_tl_pj_pengaduan->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Komentar PJ Pengaduan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->text_pj_pengaduan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Selesai Tindak Lanjut</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $done->tanggal_selesai->format('d/m/Y') }}
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
