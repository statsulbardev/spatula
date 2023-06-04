@extends('layouts.base')

@section('content')
    <div class="p-6 min-h-screen flex justify-center items-center bg-gradient">
        <div class="w-full max-w-md">
            <div class="pb-2 flex justify-center items-center">
                @include('components.logo.login')
            </div>
            <div class="bg-glass rounded-lg">
                {{ $slot }}
            </div>

            <span class="block mt-10 mb-8 mx-auto w-full max-w-xs text-center text-sm text-white">
                Dikembangkan Oleh
            </span>
            <div class="block mt-4 mx-auto w-full max-w-xs fill-white" height="45">
                @include('components.logo.bps')
            </div>
        </div>
    </div>
@overwrite
