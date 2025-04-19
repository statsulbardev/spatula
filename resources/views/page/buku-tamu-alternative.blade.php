
@extends('components.layouts.base')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-r from-primary-500 to-fuchsia-700 p-6">
    <div class="w-full hidden lg:block" style="width: 640px;">
        <div class="flex items-center justify-center pb-8">
            <x-logo.logo width="350" height="85.698" />
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
            <x-logo.logo width="350" height="85.698" />
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
