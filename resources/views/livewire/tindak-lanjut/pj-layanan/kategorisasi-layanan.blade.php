@section('title', 'Kategorisasi')

<div>
    {{-- Header --}}
    <h1 class="mb-8 font-bold text-3xl">
        <a href="{{  url(env('APP_URL') . '/tindak-lanjut/pj-layanan') }}" class="text-primary-500">PJ Layanan / </a>
        <span>{{ $customer->nama_konsumen }} ({{ $customer->layanan->nama_layanan }})</span>
    </h1>
    {{-- Informasi Pengguna Layanan --}}
    <section>
        <div class="h-full">
            <!-- Table -->
            <div class="w-full mx-auto bg-white border-gray-200 shadow-sm rounded-t-md">
                <header class="pl-3 py-4 border-b border-gray-100">
                    <span class="pl-5 font-bold text-primary-500 text-lg">Informasi Pengguna Layanan</span>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td width="30%" class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nama Konsumen</td>
                                    <td width="1%" class="text-md font-medium">:</td>
                                    <td>{{ $customer->nama_konsumen }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Email</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $customer->email_konsumen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Nomor Whatsapp / Telepon</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $customer->no_wa_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Saran/Pengaduan/Kritik/Apresiasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td>{{ $customer->saran_pengaduan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="pl-5 py-3 whitespace-nowrap text-md font-medium">Saran/Pengaduan/Kritik/Apresiasi</td>
                                    <td class="text-md font-medium">:</td>
                                    <td class="pr-6">
                                        <div class="flex flex-wrap justify-between">
                                            <div class="flex">
                                                <input type="checkbox" id="input-1" name="saran" class="mr-1">
                                                <label for="input-1">Saran</label>
                                            </div>
                                            <div class="flex">
                                                <input type="checkbox" id="input-2" name="pengaduan" class="mr-1">
                                                <label for="input-2">Pengaduan</label>
                                            </div>
                                            <div class="flex">
                                                <input type="checkbox" id="input-3" name="kritik" class="mr-1">
                                                <label for="input-3">Kritik</label>
                                            </div>
                                            <div class="flex">
                                                <input type="checkbox" id="input-4" name="apresiasi" class="mr-1">
                                                <label for="input-4">Apresiasi</label>
                                            </div>
                                            <div class="flex">
                                                <input type="checkbox" id="input-5" name="lainnya" class="mr-1">
                                                <label for="input-5">Lainnya</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 bg-gray-200 border-gray-200 shadow-sm rounded-b-md">
                    <button class="btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </section>
</div>
