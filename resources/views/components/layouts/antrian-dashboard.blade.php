@extends('components.layouts.base')

@section('content')
    <div class="flex min-h-screen w-full items-center justify-center bg-gradient-to-r from-primary-500 to-fuchsia-700 p-6">
        <div class="w-full">
            <div class="flex items-center justify-center pb-8 pt-2">
                @include('components.logo.logo_antrian', ['width' => 350, 'height' => 85.698])
            </div>
            <div class=" flex justify-center">
                <div class="w-full lg:w-5/6">
                    {{ $slot }}
                </div>
            </div>

            <span class="mx-auto mb-8 mt-10 block w-full max-w-xs text-center text-sm text-white">
                Dikembangkan Oleh
            </span>
            <div class="mx-auto mt-4 block w-full max-w-xs fill-white" height="45">
                @include('components.logo.bps')
            </div>
        </div>
    </div>
@overwrite
