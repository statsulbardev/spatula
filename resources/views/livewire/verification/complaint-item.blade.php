<div class="px-4 md:px-6 2xl:px-11 py-8">
    <x-page.page-title title="Verifikasi Hasil Pengaduan {{ $complaint->nama_konsumen }}" />

    <section class="mb-6 mt-10">
        <div class="h-full">
            <!-- Table -->
            <div class="mx-auto w-full rounded-md border-gray-200 bg-white shadow-sm">
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <tbody class="divide-y divide-gray-100 text-sm">
                                <tr>
                                    <td width="25%" class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Layanan
                                    </td>
                                    <td width="1%" class="font-semibold">:</td>
                                    <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nama</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Email</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nomor Whatsapp / Telepon</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Nama Petugas</td>
                                    <td class="font-semibold">:</td>
                                    <td>{{ $complaint->petugas->nama ?? '-' }}</td>
                    </div>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Petugas</td>
                        <td class="font-semibold">:</td>
                        <td class="flex py-4">
                            @if (!is_null($complaint->rating_petugas))
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $complaint->rating_petugas)
                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                            @include('components.icon', [
                                                'name' => 'star-solid',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </span>
                                    @else
                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                            @include('components.icon', [
                                                'name' => 'star-outline',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </span>
                                    @endif
                                @endfor
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Jenis Layanan</td>
                        <td class="font-semibold">:</td>
                        <td>{{ $complaint->layanan->nama_layanan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Rating Layanan</td>
                        <td class="font-semibold">:</td>
                        <td class="flex py-4">
                            @if (!is_null($complaint->rating_layanan))
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $complaint->rating_layanan)
                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                            @include('components.icon', [
                                                'name' => 'star-solid',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </span>
                                    @else
                                        <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                            @include('components.icon', [
                                                'name' => 'star-outline',
                                                'size' => 'w-5 h-5',
                                            ])
                                        </span>
                                    @endif
                                @endfor
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Kategori Saran Pengaduan</td>
                        <td class="font-semibold">:</td>
                        <td>
                            @if (!is_null($complaint->kode_saran))
                                @if (count($complaint->kode_saran) > 1)
                                    <ul class="ml-td">
                                        @for ($i = 0; $i < count($complaint->kode_saran); $i++)
                                            <li>{{ \App\Models\m_saran::where('kode_saran', collect($complaint->kode_saran)->get($i))->pluck('nama_saran')[0] }}
                                            </li>
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
                        <td class="whitespace-nowrap py-6 pl-5 font-semibold">Saran Pengaduan</td>
                        <td class="font-semibold">:</td>
                        <td>
                            @if ($complaint->saran_pengaduan)
                                {!! $complaint->saran_pengaduan !!}
                            @else
                                -
                            @endif
                        </td>
                </div>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Notifikasi</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->tanggal_notifikasi ? $complaint->tanggal_notifikasi->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Kategorisasi</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->tanggal_kategorisasi ? $complaint->tanggal_kategorisasi->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Tindak Lanjut PJ Pelayanan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->tanggal_tl_pj_layanan ? $complaint->tanggal_tl_pj_layanan->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Komentar PJ Pelayanan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->text_pj_layanan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Tanggal Tindak Lanjut PJ Pengaduan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->tanggal_tl_pj_pengaduan ? $complaint->tanggal_tl_pj_pengaduan->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="whitespace-nowrap py-6 pl-5 font-semibold">Komentar PJ Pengaduan</td>
                    <td class="font-semibold">:</td>
                    <td>
                        {{ $complaint->text_pj_pengaduan ?? '-' }}
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
