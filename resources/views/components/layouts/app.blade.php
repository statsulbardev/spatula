@extends('components.layouts.base')

@section('content')
<div class="flex h-screen overflow-hidden">
    <x-partials.sidebar.sidebar />

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
        <x-partials.header />
        <main class="px-6 py-8">
            {{ $slot }}
        </main>
    </div>

    <button  type="button" x-data
        x-tooltip.raw="Hapus Antrian" class="hidden" data-te-toggle="modal"
        data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
    </button>

    @include('components.input.delete-confirmation')
</div>
@overwrite
