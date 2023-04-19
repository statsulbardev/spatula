@extends('layouts.base')

@section('content')
<div class="p-6 min-h-screen flex justify-center items-center bg-gradient">
    <div class="w-full max-w-md">
        <div class="bg-glass rounded-lg">
            <div class="mx-auto w-9/12 fill-white">
                {{-- @include('components.logo') --}}
            </div>

            {{ $slot }}
        </div>

        <span class="block mt-10 mb-8 mx-auto w-full max-w-xs text-center text-sm text-white">
            Dikembangkan Oleh
        </span>
        <div class="block mt-4 mx-auto w-full max-w-xs fill-white" height="45">
            {{-- @include('components.bps-logo') --}}
        </div>
    </div>
</div>
@overwrite
