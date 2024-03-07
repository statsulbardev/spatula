@extends('layouts.base')

@section('content')
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('components.partials.sidebar')

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

@push('scripts')
    <script>
        window.addEventListener('notification', event => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: event.detail.message
            }));
        })
    </script>
@endpush