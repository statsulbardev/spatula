@extends('layouts.base')

@section('content')
    @include('components.notification.flash')
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <x-partials.sidebar.sidebar />

        {{-- Content Area --}}
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            {{-- Header --}}
            @include('components.partials.header')

            {{-- Content Main --}}
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
@overwrite
