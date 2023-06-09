@section('title', 'Dashboard')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Dashboard Spatula'])

    <section class="mb-6 mt-10 columns-1 lg:columns-2 gap-4 space-y-4 mx-auto">
        {{-- Informasi Verifikasi --}}
        <div class="break-inside-avoid">
            <div class="bg-white rounded-md shadow-md mb-4 lg:mr-4">
                {{-- Card Header --}}
                <div class="border-b mb-2 p-4 text-sm font-medium">INFORMASI LAYANAN</div>
                {{-- Card Content --}}
                <div class="flex flex-wrap">
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'check-circle', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Selesai Diverifikasi</div>
                                <span class="font-bold text-xl">{{ $completes }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'question-mark-circle', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Belum Diverifikasi</div>
                                <span class="font-bold text-xl">{{ $notCompletes }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'list-bullet', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Verifikasi PJ Layanan</div>
                                <span class="font-bold text-xl">{{ $serviceResponsible }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'list-bullet', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Verifikasi PJ Pengaduan</div>
                                <span class="font-bold text-xl">{{ $complaintResponsible }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Saran Pengaduan --}}
        <div class="break-inside-avoid">
            <div class="bg-white rounded-md shadow-md mb-4 lg:mr-4">
                {{-- Card Header --}}
                <div class="border-b mb-2 p-4 text-sm font-medium">KATEGORI SARAN PENGADUAN</div>
                {{-- Card Content --}}
                <div class="flex flex-wrap">
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'chat-bubble-bottom', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Saran</div>
                                <span class="font-bold text-xl">{{ $categorize[1] ?? 0 }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'face-down', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Pengaduan</div>
                                <span class="font-bold text-xl">{{ $categorize[2] ?? 0 }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'fire', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Kritik</div>
                                <span class="font-bold text-xl">{{ $categorize[3] ?? 0 }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'hand-thumb-up', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Apresiasi</div>
                                <span class="font-bold text-xl">{{ $categorize[4] ?? 0 }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'question-mark-circle', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Lainnnya</div>
                                <span class="font-bold text-xl">{{ $categorize[9] ?? 0 }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 w-full lg:w-1/2">
                        <div class="flex items-center">
                            {{-- Icon --}}
                            <div class="bg-gradient-to-b from-primary-500 to-fuchsia-700 rounded-lg p-2 text-white">
                                @include('components.icon', ['name' => 'bookmark-slash', 'size' => 'w-8 h-8'])
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-primary-500">Belum Kategorisasi</div>
                                <span class="font-bold text-xl">{{ $notCategorize }}</span><small class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card Footer --}}
                <div class="border-t italic mt-2 p-4 text-sm">
                    Catatan : Penilaian bisa saja memiliki lebih dari satu kategori saran pengaduan.
                </div>
            </div>
        </div>

        {{-- Petugas Layanan --}}
        <div class="break-inside-avoid">
            <div class="bg-white rounded-md shadow-md">
                {{-- Card Header --}}
                <div class="border-b mb-2 p-4 text-sm font-medium">PETUGAS LAYANAN</div>
                {{-- Card Content --}}
                <div class="p-4">
                    @foreach ($officers as $officerIndex => $officer)
                    <div class="flex flex-wrap px-4 py-2 border mb-2 rounded-md">
                        <div class="flex items-center w-full lg:w-2/3">
                            {{-- Foto --}}
                            <img class="block h-12 w-12 rounded-full"
                                src="https://www.clipartmax.com/png/small/6-61698_lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-avatar-login.png">
                            {{-- Identitas --}}
                            <div class="ml-2">
                                <div class="font-semibold text-base">{{ array_column($this->listOfficers,
                                    $officerIndex)[0]['nama'] ?? 'Belum Assign Petugas' }}</div>
                                <span class="text-xs text-primary-500">{{ array_column($this->listOfficers,
                                    $officerIndex)[0]['email'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/3">
                            <div class="text-xs text-gray-400 text-right">Jumlah Penugasan</div>
                            <div class="text-right">
                                <span class="text-xl font-bold">{{ $officers->get($officerIndex) }}</span><small
                                    class="ml-1">penilaian</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Jenis Layanan --}}
        <div class="break-inside-avoid">
            <div class="bg-white rounded-md shadow-md">
                {{-- Card Header --}}
                <div class="border-b mb-2 p-4 text-sm font-medium">LAYANAN DENGAN KEPUASAN TERTINGGI</div>
                {{-- Card Content --}}
                <div class="p-4">
                    @foreach ($ratingService as $indexRatingService => $item)
                        <div class="flex flex-wrap px-4 py-2 border mb-2 rounded-md">
                            <div class="flex items-center w-full lg:w-2/3">
                                <div class="ml-2">
                                    <div class="font-semibold text-base">{{ array_column($this->services, $indexRatingService)[0] }}</div>
                                    <span class="mt-1 text-xs text-primary-500 flex">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="{{ $i == 0 ?: 'ml-2' }} text-secondary-400">
                                                @include('components.icon', [
                                                    'name' => 'star-solid',
                                                    'size' => 'w-3 h-3',
                                                ])
                                            </span>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3">
                                <div class="text-xs text-gray-400 text-right">Rata-Rata</div>
                                <div class="text-xl font-bold text-right">{{ $ratingService->get($indexRatingService) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
