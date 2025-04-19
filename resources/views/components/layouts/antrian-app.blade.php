@extends('components.layouts.base')

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
    <button  type="button" x-data
        x-tooltip.raw="Hapus Antrian" class="hidden" data-te-toggle="modal"
        data-te-target="#deleteModal" data-te-ripple-init data-te-ripple-color="light">
    </button>
@overwrite
