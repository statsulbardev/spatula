@section('title', 'Dashboard')

<div>
    {{-- Header --}}
    @include('components.page.page-title', ['title' => 'Dashboard Spatula'])

    {{-- Breadcrumb --}}
    @include('partials.breadcrumb')

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow rounded p-4">
                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-lg bg-blue-100">
                    <span class="w-6 h-6 fill-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 431.497 431.498">
                            <g>
                                <path
                                    d="M10.107,111.108h308.148c5.544,0,10.019-4.483,10.019-10.016V10.016C328.274,4.486,323.8,0,318.256,0H10.107 C4.569,0,0.091,4.486,0.091,10.016v91.076C0.091,106.625,4.569,111.108,10.107,111.108z M32.66,26.675h131.523v52.609H32.66V26.675 z M328.28,193.232v-48.87c0-5.533-4.48-10.019-10.013-10.019H10.107c-5.539,0-10.016,4.486-10.016,10.019v91.076 c0,5.532,4.478,10.024,10.016,10.024h186.898v-16.497c0-19.709,16.027-35.733,35.734-35.733H328.28z M164.183,212.276H32.66 v-52.609h131.523V212.276z M0.091,277.416v91.073c0,5.533,4.478,10.019,10.016,10.019h186.898V267.403H10.107 C4.569,267.403,0.091,271.883,0.091,277.416z M32.66,296.649h131.523v52.612H32.66V296.649z M414.4,214.416L414.4,214.416H241.546 c-8.026,0-14.552,6.522-14.552,14.549v155.081h0.047c0.236,2.518,2.275,4.479,4.8,4.479c2.523,0,4.574-1.962,4.806-4.479h0.047 V228.971c0-2.672,2.181-4.847,4.853-4.847h148.798c2.672,0,4.858,2.163,4.858,4.847v187.975c0,2.671-2.181,4.847-4.858,4.847 h-19.399c-1.785-0.757-8.949-4.161-8.949-9.422c0-6.053,9.334-9.8,9.41-9.836c2.193-0.827,3.487-3.097,3.062-5.402 c-0.414-2.317-2.418-3.995-4.765-3.995H232.16c-10.545,0-19.122,8.576-19.122,19.115c0,10.545,8.577,19.127,19.122,19.127h132.306 c-0.012,0.035-0.012,0.077-0.023,0.118h25.901c8.015,0,14.546-6.525,14.546-14.552V230.768c0.077-6.833,8.382-6.655,9.321-6.655 h0.042c4.107,0,7.453,3.352,7.453,7.459c0,4.114-3.346,7.454-7.453,7.454c-2.678,0-4.853,2.169-4.853,4.853 s2.175,4.847,4.853,4.847c9.463,0,17.153-7.695,17.153-17.153C431.406,222.103,423.716,214.416,414.4,214.416z M355.293,421.668 H232.16c-5.19,0-9.422-4.227-9.422-9.416c0-5.195,4.231-9.422,9.422-9.422h123.269c-1.85,2.601-3.139,5.757-3.139,9.528 C352.302,416.047,353.52,419.138,355.293,421.668z">
                                </path>
                            </g>
                        </svg>
                    </span>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Petugas Aktif</div>
                    <div class="font-bold text-lg mt-2">{{ $petugasAktif }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow rounded p-4">
                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-lg bg-green-100">
                    <span class="w-6 h-6 fill-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-thumbs-up">
                            <path class="primary"
                                d="M13 4.8l2.92 6.8a1 1 0 0 1 .08.4v8a2 2 0 0 1-2 2H8a4.28 4.28 0 0 1-3.7-2.45L2.07 14.4A1 1 0 0 1 2 14v-2a3 3 0 0 1 3-3h4V5a3 3 0 0 1 3-3 1 1 0 0 1 1 1v1.8z">
                            </path>
                            <rect width="4" height="11" x="18" y="11" class="secondary"
                                rx="1"></rect>
                        </svg>
                    </span>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Perangkat Bagus</div>
                    <div class="font-bold text-lg mt-2">150 <small>dari</small> 214 unit</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow rounded p-4">
                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-lg bg-red-100">
                    <span class="w-6 h-6 fill-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-thumbs-down">
                            <path class="primary"
                                d="M11 19.2l-2.92-6.8A1 1 0 0 1 8 12V4c0-1.1.9-2 2-2h6c1.5 0 3.11 1.06 3.7 2.45l2.22 5.16A1 1 0 0 1 22 10v2a3 3 0 0 1-3 3h-4v4a3 3 0 0 1-3 3 1 1 0 0 1-1-1v-1.8z">
                            </path>
                            <rect width="4" height="11" x="2" y="2" class="secondary"
                                rx="1" transform="rotate(180 4 7.5)"></rect>
                        </svg>

                    </span>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Perangkat Rusak</div>
                    <div class="font-bold text-lg mt-2">6 <small>dari</small> 214 <small>unit</small></div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow rounded p-4">
                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-lg bg-red-100">
                    <span class="w-6 h-6 fill-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360.574 360.574">
                            <g>
                                <path
                                    d="M348.335,316.314c-7.929,15.238-67.787,113.154-230.162-43.109C-53.002,108.452,9.25,37.39,38.621,16.527v-0.049 c0.465-0.332,0.943-0.605,1.419-0.925c0.829-0.572,1.613-1.081,2.376-1.565c0.33-0.194,0.667-0.43,1.004-0.632 c4.218-2.588,7.008-3.775,7.008-3.775s0,0.093,0.011,0.235c20.643-8.892,42.865-5.16,51.226,12.796l16.977,41.234 c9.962,21.412-1.434,52.695-25.461,69.896l-1.945,1.39c25.697,45.52,67.497,95.019,135.403,132.961l3.249-4.553 c17.192-24.032,48.476-35.414,69.888-25.466l38.211,20.002C358.879,267.804,364.108,292.719,348.335,316.314z M303.653,54.72 h-84.106c-3.207,0-5.799,2.602-5.799,5.806c0,3.201,2.592,5.8,5.799,5.8h84.106c3.199,0,5.799-2.599,5.799-5.8 C309.452,57.321,306.852,54.72,303.653,54.72z M303.653,89.333h-84.106c-3.207,0-5.799,2.594-5.799,5.797 c0,3.207,2.592,5.801,5.799,5.801h84.106c3.199,0,5.799-2.594,5.799-5.801C309.452,91.926,306.852,89.333,303.653,89.333z M352.468,75.404c0,25.976-16.366,50.345-42.853,64.039c-19.563,39.25-64.267,40.399-69.374,40.399l0,0l-0.715-0.005 c-2.53-0.082-4.725-1.792-5.412-4.235c-0.686-2.433,0.29-5.031,2.405-6.422c8.324-5.447,14.978-11.639,19.875-18.492 c-47.699-2.246-85.668-35.155-85.668-75.29C170.727,33.819,211.488,0,261.598,0C311.707,0.005,352.468,33.825,352.468,75.404z M340.872,75.404c0-35.174-35.566-63.801-79.273-63.801c-43.709,0-79.266,28.622-79.266,63.801 c0,35.182,35.557,63.814,79.266,63.814c1.573,0,3.127-0.049,4.668-0.122c0.09-0.007,0.191-0.007,0.281-0.007 c1.937,0,3.748,0.969,4.832,2.588c1.13,1.699,1.278,3.866,0.402,5.716c-3.119,6.511-7.354,12.58-12.673,18.145 c13.74-3.677,31.387-12.372,40.87-32.826c0.563-1.198,1.521-2.178,2.711-2.755C326.595,118.228,340.872,97.839,340.872,75.404z">
                                </path>
                            </g>
                        </svg>

                    </span>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Tiket Dikelola</div>
                    <div class="font-bold text-lg mt-2">0 <small>tiket</small></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Counts Section-->
    {{-- <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="icon-user"></i></div>
                        <div class="title"><span>Petugas<br>Aktif</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                            </div>
                        </div>
                        <div class="number"><strong>{{ $petugasAktif }}</strong></div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-red"><i class="icon-padnote"></i></div>
                        <div class="title"><span>Penilaian<br>Petugas</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                            </div>
                        </div>
                        <div class="number"><strong>{{ $penilaianPetugas }}</strong></div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="icon-bill"></i></div>
                        <div class="title"><span>Penilaian<br>Layanan</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                        <div class="number"><strong>{{ $penilaianLayanan }}</strong></div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-orange"><i class="icon-check"></i></div>
                        <div class="title"><span>Jumlah<br>Pengaduan</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                            </div>
                        </div>
                        <div class="number"><strong>{{ $jumlahPengaduan }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
</div>
