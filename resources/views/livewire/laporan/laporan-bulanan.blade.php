@section('title', 'Laporan Bulanan')

<div>
    <div class="flex flex-no-wrap justify-between mb-8">
        {{-- Header --}}
        @include('components.page.page-title', ['title' => 'Laporan Bulanan Tahun ' . $selectedYear])

        {{-- Menu --}}
        <ul class="flex flex-nowrap" role="tablist" data-te-nav-ref>
            <li class="bg-white border-1 font-medium leading-tight p-3 rounded-l-md shadow hover:bg-gray-100" role="presentation">
                <a
                    href="rating-petugas-layanan"
                    class="block uppercase text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary text-sm"
                    data-te-toggle="pill"
                    data-te-target="#rating-petugas-layanan"
                    data-te-nav-active
                    role="tab"
                    aria-controls="rating-petugas-layanan"
                    aria-selected="true">
                    Rating Petugas Layanan
                </a>
            </li>
            <li class="bg-white border-1 font-medium leading-tight p-3 shadow hover:bg-gray-100" role="presentation">
                <a
                    href="#rating-layanan"
                    class="block uppercase text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary text-sm"
                    data-te-toggle="pill"
                    data-te-target="#rating-layanan"
                    role="tab"
                    aria-controls="rating-layanan"
                    aria-selected="false">Rating Layanan
                </a>
            </li>
            <li class="bg-white border-1 font-medium leading-tight p-3 rounded-r-md shadow hover:bg-gray-100" role="presentation">
                <a
                    href="#saran-pengaduan"
                    class="block uppercase text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary text-sm"
                    data-te-toggle="pill"
                    data-te-target="#saran-pengaduan"
                    role="tab"
                    aria-controls="saran-pengaduan"
                    aria-selected="false">
                    Saran Pengaduan
                </a>
            </li>
        </ul>
    </div>

    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow">
            <div class="p-4 flex flex-wrap justify-between">
                {{-- Tab --}}
                <div class="px-4 flex flex-wrap items-center justify-between">
                    <div class="year">
                        <select wire:model="selectedYear" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                            <option hidden selected>Pilih Tahun ...</option>
                            @foreach ($this->years as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Tahun</label>
                    </div>
                </div>
            </div>
            {{-- Content --}}
            <div class="mb-6">
                {{-- Rating Petugas --}}
                <div
                    class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="rating-petugas-layanan"
                    role="tabpanel"
                    aria-labelledby="rating-petugas-layanan-tab"
                    data-te-tab-active>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="text-left font-bold bg-neutral-100">
                                @foreach ($officerRating[0] as $columnOfficer)
                                    <th class="px-6 pt-6 pb-4">{{ $columnOfficer }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officerRating[1] as $reportOfficer)
                                <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                    <td class="border-t">
                                        <span class="pl-6 py-4 items-center">
                                            {{ $this->months[$reportOfficer->bulan - 1][1] }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportOfficer->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4 flex items-center">
                                            {{ round($reportOfficer->rerata, 2) }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportOfficer->jumlah_terlayani }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Rating Layanan --}}
                <div
                    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="rating-layanan"
                    role="tabpanel"
                    aria-labelledby="rating-layanan-tab">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="text-left font-bold bg-neutral-100">
                                @foreach ($serviceRating[0] as $columnService)
                                    <th class="px-6 pt-6 pb-4">{{ $columnService }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceRating[1] as $reportService)
                                <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                    <td class="border-t">
                                        <span class="pl-6 py-4 items-center">
                                            {{ $this->months[$reportService->bulan - 1][1] }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportService->nama_layanan ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4 flex items-center">
                                            {{ round($reportService->rerata, 2) }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportService->jumlah_terlayani }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Saran Pengaduan --}}
                <div
                    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="saran-pengaduan"
                    role="tabpanel"
                    aria-labelledby="rating-layanan-tab">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="text-left font-bold bg-neutral-100">
                                @foreach ($serviceRating[0] as $columnService)
                                    <th class="px-6 pt-6 pb-4">{{ $columnService }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceRating[1] as $reportService)
                                <tr class="hover:bg-gray-200 focus-within:bg-grey-lightest">
                                    <td class="border-t">
                                        <span class="pl-6 py-4 items-center">
                                            {{ $this->months[$reportService->bulan - 1][1] }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportService->nama_layanan ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4 flex items-center">
                                            {{ round($reportService->rerata, 2) }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="pl-6 py-4">
                                            {{ $reportService->jumlah_terlayani }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
