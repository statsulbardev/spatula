@extends('layouts.base')

@section('content')
    <div class="bg-gradient flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="flex items-center justify-center pb-2">
                @include('components.logo.login')
            </div>
            <div class="bg-glass rounded-lg">
                {{ $slot }}
            </div>

            <span class="mx-auto mb-8 mt-10 block w-full max-w-xs text-center text-sm text-white">
                Dikembangkan Oleh
            </span>
            <div class="mx-auto mt-4 block w-full max-w-xs fill-white"
                 height="45">
                @include('components.logo.bps')
            </div>
        </div>
    </div>
@overwrite
