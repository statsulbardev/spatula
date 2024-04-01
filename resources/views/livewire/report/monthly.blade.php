<div class="px-4 md:px-6 2xl:px-11 py-8">
    <div class="flex flex-none justify-between">
        <x-page.page-title title="Laporan Bulanan Tahun {{ $selectedYear }}" />

        {{-- Menu --}}
        <ul class="flex flex-nowrap" role="tablist" data-te-nav-ref>
            <li class="border-l-2 border-t-2 border-b-2 border-primary-100 drop-shadow-sm rounded-l-md bg-white px-4 py-2 leading-tight hover:bg-gray-300" role="presentation">
                <a
                    href="rating-petugas-layanan"
                    class="align-middle text-sm text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary-500 data-[te-nav-active]:font-bold"
                    data-te-toggle="pill"
                    data-te-target="#rating-petugas-layanan"
                    data-te-nav-active
                    role="tab"
                    aria-controls="rating-petugas-layanan"
                    aria-selected="true">
                    Rating Petugas Layanan
                </a>
            </li>
            <li class="border-l-2 border-t-2 border-b-2 border-primary-100 drop-shadow-sm bg-white px-4 py-2 font-medium leading-tight hover:bg-gray-300" role="presentation">
                <a
                    href="#rating-layanan"
                    class="align-middle text-sm text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary-500 data-[te-nav-active]:font-bold"
                    data-te-toggle="pill"
                    data-te-target="#rating-layanan"
                    role="tab"
                    aria-controls="rating-layanan"
                    aria-selected="false">
                    Rating Layanan
                </a>
            </li>
            <li class="border-2 border-primary-100 drop-shadow-sm rounded-r-md bg-white px-4 py-2 font-medium leading-tight hover:bg-gray-300" role="presentation">
                <a
                    href="#saran-pengaduan"
                    class="align-middle text-sm text-neutral-500 hover:isolate focus:isolate data-[te-nav-active]:text-primary-500 data-[te-nav-active]:font-bold"
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

    <section class="mb-6 mt-10">
        <div class="w-full overflow-x-auto rounded bg-white shadow">
            <div class="flex flex-wrap justify-between p-4">
                {{-- Tab --}}
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <label for="tahun" class="text-sm text-primary-400 font-bold tracking-wider">Tahun</label>
                        <select id="tahun" wire:model.live="selectedYear" class="form-select min-w-40">
                            <option hidden selected>Pilih Tahun ...</option>
                            @foreach ($this->years as $item)
                                @if ($selectedYear == $item)
                                    <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Content --}}
            <div class="mb-6">
                {{-- Rating Petugas --}}
                <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="rating-petugas-layanan" role="tabpanel" aria-labelledby="rating-petugas-layanan-tab" data-te-tab-active>
                    <table class="w-full table-fixed overflow-auto text-base font-light">
                        <thead>
                            <tr class="bg-neutral-100 text-left font-bold">
                                @foreach ($officerRating[0] as $columnOfficer)
                                    <th class="px-6 pb-4 pt-6">{{ $columnOfficer }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officerRating[1] as $monthIndex => $reportOfficer)
                                <tr class="focus-within:bg-grey-lightest">
                                    @if ($reportOfficer->count() == 1)
                                        <td class="border-t">
                                            <span class="items-center py-4 pl-6">
                                                {{ array_column($this->months, $monthIndex)[0] }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="py-4 pl-6">
                                                {{ $reportOfficer->flatten()[0]->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="flex items-center py-4 pl-6">
                                                {{ round($reportOfficer->flatten()[0]->rerata, 2) }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="py-4 pl-6">
                                                {{ $reportOfficer->flatten()[0]->jumlah_terlayani }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="border-t" rowspan="{{ $reportOfficer->count() + 1 }}">
                                            <span class="items-center py-4 pl-6">
                                                {{ array_column($this->months, $monthIndex)[0] }}
                                            </span>
                                        </td>
                                        @foreach ($reportOfficer as $subReportOfficer)
                                <tr>
                                    <td class="border-t">
                                        <span class="py-4 pl-6">
                                            {{ $subReportOfficer->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="flex items-center py-4 pl-6">
                                            {{ round($subReportOfficer->rerata, 2) }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="py-4 pl-6">
                                            {{ $subReportOfficer->jumlah_terlayani }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Rating Layanan --}}
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="rating-layanan"
                    role="tabpanel" aria-labelledby="rating-layanan-tab">
                    <table class="w-full table-auto overflow-auto text-base font-light">
                        <thead>
                            <tr class="bg-neutral-100 text-left font-bold">
                                @foreach ($serviceRating[0] as $columnService)
                                    <th class="px-6 pb-4 pt-6">{{ $columnService }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceRating[1] as $monthIndex => $reportService)
                                <tr class="focus-within:bg-grey-lightest">
                                    @if ($reportService->count() == 1)
                                        <td class="border-t">
                                            <span class="items-center py-4 pl-6">
                                                {{ array_column($this->months, $monthIndex)[0] }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="py-4 pl-6">
                                                {{ $reportService->flatten()[0]->nama_layanan ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="flex items-center py-4 pl-6">
                                                {{ round($reportService->flatten()[0]->rerata, 2) }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="py-4 pl-6">
                                                {{ $reportService->flatten()[0]->jumlah_terlayani }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="border-t" rowspan="{{ $reportService->count() + 1 }}">
                                            <span class="items-center py-4 pl-6">
                                                {{ array_column($this->months, $monthIndex)[0] }}
                                            </span>
                                        </td>
                                        @foreach ($reportService as $subReportService)
                                <tr>
                                    <td class="border-t">
                                        <span class="py-4 pl-6">
                                            {{ $subReportService->nama_layanan ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="flex items-center py-4 pl-6">
                                            {{ round($subReportService->rerata, 2) }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="py-4 pl-6">
                                            {{ $subReportService->jumlah_terlayani }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Saran Pengaduan --}}
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="saran-pengaduan"
                    role="tabpanel" aria-labelledby="rating-layanan-tab">
                    <table class="w-full table-auto overflow-auto text-base font-light">
                        <thead>
                            <tr class="bg-neutral-100 text-left font-bold">
                                @foreach ($complaintSuggestion[0] as $columnComplaintSuggestion)
                                    <th class="px-6 pb-4 pt-6">{{ $columnComplaintSuggestion }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaintSuggestion[1] as $monthIndex => $report)
                                <tr class="focus-within:bg-grey-lightest">
                                    <td class="border-t" rowspan="{{ $report->count() + 1 }}">
                                        <span class="items-center py-4 pl-6">
                                            {{ array_column($this->months, $monthIndex)[0] }}
                                        </span>
                                    </td>
                                    @foreach ($report as $index => $item)
                                <tr>
                                    <td class="border-t">
                                        <span class="py-4 pl-6">
                                            {{ '(' . $index . ') ' . array_column($this->suggestions, $index)[0] }}
                                        </span>
                                    </td>
                                    <td class="border-t">
                                        <span class="flex items-center py-4 pl-6">
                                            {{ $item }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
