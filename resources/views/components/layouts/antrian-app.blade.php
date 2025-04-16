@extends('layouts.base')

@section('content')
    <div class="flex h-screen overflow-hidden">
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <x-partials.header_antrian />

            {{-- Content Main --}}
            <main class="flex justify-center ">
                {{ $slot }}
            </main>
        </div>
    </div>
@overwrite
