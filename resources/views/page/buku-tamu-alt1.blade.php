
@extends('layouts.base')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-r from-primary-500 to-fuchsia-700 p-6">
    <div class="w-full hidden lg:block" style="width: 640px;">
        <div class="flex items-center justify-center pb-8">
            <svg width="350" height="85.698" viewBox="0 0 129.5 31.708" xmlns="http://www.w3.org/2000/svg">
                <g fill="#fff"><text x="28.116" y="21.479" font-size="23.523" stroke-width=".98" transform="translate(0 -1.022)">
                        <tspan style="-inkscape-font-specification:'Jost Medium'" x="28.116" y="21.479" font-weight="500" font-family="Jost">
                            SPATULA</tspan>
                    </text><text x="28.81" y="27.74" font-size="4.224" stroke-width=".176" transform="translate(0 -1.022)">
                        <tspan style="-inkscape-font-specification:'Jost Medium'" x="30" y="27.74" font-weight="500" font-family="Jost">
                            Spatula Modul Buku Tamu Online</tspan>
                    </text>
                    <path
                        d="M12.975 2.322c.461-.02.825.14 1.193.374.466.296.991.881 1.64 1.251.913.521 2.601-.198 3.465 1.087.504.749.528 1.336.566 1.917.04.625.15 1.201.791 2.048 1.062 1.404 1.283 2.338.736 3.31-.372.663-1.157 1.031-1.338 1.453-.387.893.04 1.567-.487 2.61a2.78 2.78 0 01-1.689 1.442c-.636.204-1.274-.092-1.784.123-.896.377-1.555 1.25-2.268 1.472a2.697 2.697 0 01-.823.126 2.697 2.697 0 01-.823-.126c-.713-.221-1.372-1.095-2.268-1.472-.51-.215-1.148.083-1.784-.123a2.78 2.78 0 01-1.69-1.442c-.529-1.043-.101-1.717-.486-2.61-.181-.422-.966-.79-1.338-1.453-.551-.972-.33-1.906.731-3.308.64-.846.751-1.423.792-2.048.038-.58.061-1.168.565-1.917.866-1.285 2.555-.566 3.465-1.087.65-.37 1.175-.955 1.64-1.25.366-.237.732-.398 1.194-.377zm0 5.522l.948 2.319 2.5.185-1.912 1.618.595 2.434-2.131-1.319-2.132 1.319.596-2.434-1.912-1.618 2.499-.185zm9.1 18.527l-2.457-.44-1.22 2.182c-.884 1.096-1.446-.706-1.692-1.333l-2.372-4.474c.547-.19 1.206-.736 1.882-1.35 1.351.027 2.61-.207 3.536-1.385l2.725 5.264.236.507c.187.657.089 1.09-.639 1.03zm-18.202 0l2.459-.44 1.219 2.182c.884 1.096 1.446-.706 1.693-1.333l2.372-4.474c-.547-.19-1.207-.736-1.883-1.35-1.35.027-2.61-.207-3.535-1.385L3.47 24.835l-.236.507c-.187.657-.09 1.09.638 1.03zm9.076-20.626a5.316 5.316 0 110 10.632 5.316 5.316 0 010-10.632z"
                        fill-rule="evenodd" clip-rule="evenodd" />
                </g>
            </svg>

        </div>
        <div class="bg-glass rounded-lg">
            <div class="overflow-hidden rounded-lg">
                <div class="w-full max-w-md">
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScFCzJDKc2dwRErsI3WuGNZBZkgxTjIvM1nWirsRiC6EoV4NA/viewform?embedded=true" width="640" height="2094" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                </div>
            </div>
        </div>

        <span class="mx-auto mb-8 mt-10 block w-full max-w-xs text-center text-sm text-white">
            Dikembangkan Oleh
        </span>
        <div class="mx-auto mt-4 block w-full max-w-xs fill-white" height="45">
            <x-logo.bps />
        </div>
    </div>
    <div class="w-full block lg:hidden" style="width: 320px;">
        <div class="flex items-center justify-center pb-8">
            <svg width="350" height="85.698" viewBox="0 0 129.5 31.708" xmlns="http://www.w3.org/2000/svg">
                <g fill="#fff"><text x="28.116" y="21.479" font-size="23.523" stroke-width=".98" transform="translate(0 -1.022)">
                        <tspan style="-inkscape-font-specification:'Jost Medium'" x="28.116" y="21.479" font-weight="500" font-family="Jost">
                            SPATULA</tspan>
                    </text><text x="28.81" y="27.74" font-size="4.224" stroke-width=".176" transform="translate(0 -1.022)">
                        <tspan style="-inkscape-font-specification:'Jost Medium'" x="30" y="27.74" font-weight="500" font-family="Jost">
                            Spatula Modul Buku Tamu Online</tspan>
                    </text>
                    <path
                        d="M12.975 2.322c.461-.02.825.14 1.193.374.466.296.991.881 1.64 1.251.913.521 2.601-.198 3.465 1.087.504.749.528 1.336.566 1.917.04.625.15 1.201.791 2.048 1.062 1.404 1.283 2.338.736 3.31-.372.663-1.157 1.031-1.338 1.453-.387.893.04 1.567-.487 2.61a2.78 2.78 0 01-1.689 1.442c-.636.204-1.274-.092-1.784.123-.896.377-1.555 1.25-2.268 1.472a2.697 2.697 0 01-.823.126 2.697 2.697 0 01-.823-.126c-.713-.221-1.372-1.095-2.268-1.472-.51-.215-1.148.083-1.784-.123a2.78 2.78 0 01-1.69-1.442c-.529-1.043-.101-1.717-.486-2.61-.181-.422-.966-.79-1.338-1.453-.551-.972-.33-1.906.731-3.308.64-.846.751-1.423.792-2.048.038-.58.061-1.168.565-1.917.866-1.285 2.555-.566 3.465-1.087.65-.37 1.175-.955 1.64-1.25.366-.237.732-.398 1.194-.377zm0 5.522l.948 2.319 2.5.185-1.912 1.618.595 2.434-2.131-1.319-2.132 1.319.596-2.434-1.912-1.618 2.499-.185zm9.1 18.527l-2.457-.44-1.22 2.182c-.884 1.096-1.446-.706-1.692-1.333l-2.372-4.474c.547-.19 1.206-.736 1.882-1.35 1.351.027 2.61-.207 3.536-1.385l2.725 5.264.236.507c.187.657.089 1.09-.639 1.03zm-18.202 0l2.459-.44 1.219 2.182c.884 1.096 1.446-.706 1.693-1.333l2.372-4.474c-.547-.19-1.207-.736-1.883-1.35-1.35.027-2.61-.207-3.535-1.385L3.47 24.835l-.236.507c-.187.657-.09 1.09.638 1.03zm9.076-20.626a5.316 5.316 0 110 10.632 5.316 5.316 0 010-10.632z"
                        fill-rule="evenodd" clip-rule="evenodd" />
                </g>
            </svg>
        </div>
        <div class="bg-glass rounded-lg">
            <div class="overflow-hidden rounded-lg">
                <div class="w-full max-w-md">
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScFCzJDKc2dwRErsI3WuGNZBZkgxTjIvM1nWirsRiC6EoV4NA/viewform?embedded=true" width="320" height="2094" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                </div>
            </div>
        </div>

        <span class="mx-auto mb-8 mt-10 block w-full max-w-xs text-center text-sm text-white">
            Dikembangkan Oleh
        </span>
        <div class="mx-auto mt-4 block w-full max-w-xs fill-white" height="45">
            <x-logo.bps />
        </div>
    </div>
</div>
@overwrite
