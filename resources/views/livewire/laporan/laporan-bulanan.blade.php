@section('title', 'Laporan Bulanan')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Laporan Bulanan Tahun ' . $selectedYear])

    <section class="mt-10 mb-6">
        <div class="w-full bg-white rounded shadow overflow-x-auto">
            <div class="items-center justify-between">
                {{-- Tab --}}
                <div class="px-4 flex flex-wrap items-center justify-between">
                    <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0" role="tablist" data-te-nav-ref>
                        <li role="presentation">
                            <a
                                href="#rating-petugas-layanan"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                                data-te-toggle="pill"
                                data-te-target="#rating-petugas-layanan"
                                data-te-nav-active
                                role="tab"
                                aria-controls="rating-petugas-layanan"
                                aria-selected="true">
                                Rating Petugas Layanan
                            </a>
                        </li>
                        <li role="presentation">
                            <a
                                href="#rating-layanan"
                                class="focus:border-transparen my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                                data-te-toggle="pill"
                                data-te-target="#rating-layanan"
                                role="tab"
                                aria-controls="rating-layanan"
                                aria-selected="false">Rating Layanan
                            </a>
                        </li>
                        <li role="presentation">
                            <a
                                href="#saran-pengaduan"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                                data-te-toggle="pill"
                                data-te-target="#saran-pengaduan"
                                role="tab"
                                aria-controls="saran-pengaduan"
                                aria-selected="false">
                                Saran Pengaduan
                            </a>
                        </li>
                    </ul>

                    <div class="year">
                        <select wire:model="selectedYear" data-te-select-init data-te-select-filter="true" data-te-select-size="lg">
                            <option value="null" hidden selected>Pilih Tahun ...</option>
                            @foreach ($years as $yearItem)
                                <option value="{{ $yearItem }}">{{ $yearItem }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Tahun</label>
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
                        <table class="w-full table-auto">
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
                                                {{ date('F', mktime(0, 0, 0, $reportOfficer->bulan, 10)) }}
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
                        <table class="w-full table-auto">
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
                                                {{ date('F', mktime(0, 0, 0, $reportService->bulan, 10)) }}
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
                    Tab 3 content
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
