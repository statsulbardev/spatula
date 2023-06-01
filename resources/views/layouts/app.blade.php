@extends('layouts.base')

@section('content')
<div class="flex">
    {{-- Mobile menu toggle --}}
    <button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen"
        class="sm:hidden absolute top-5 right-5 focus:outline-none">
        {{-- Menu icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" x-bind:class="$store.sidebar.navOpen ? 'hidden':''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
        {{-- Close menu --}}
        <svg x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" x-bind:class="$store.sidebar.navOpen ? '':'hidden'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Sidebar --}}
    <div class="bg-primary-500 fixed transition-all duration-300 space-y-2 sm:relative"
        x-bind:class="{'w-64':$store.sidebar.full, 'w-64 sm:w-20':!$store.sidebar.full,'top-0 left-0':$store.sidebar.navOpen,'top-0 -left-64 sm:left-0':!$store.sidebar.navOpen}">

        {{-- Logo Aplikasi --}}
        <div class="w-full bg-primary-600 h-14 flex justify-center items-center" x-data="{ show: false }">
            <template x-if="$store.sidebar.full != show">
                <div>
                    @include('components.logo.smalltwo')
                </div>
            </template>
            <template x-if="$store.sidebar.full == show">
                <div>
                    @include('components.logo.small')
                </div>
            </template>
        </div>

        <div class="h-screen">
            @include('components.menu')
        </div>
    </div>

    <div class="w-screen">
        {{-- Topbar --}}
        <div class="h-14 bg-white border-b md:px-8 text-sm flex justify-between items-center">
            <div>
                @include('partials.breadcrumb')
            </div>
            <div>BPS Provinsi Sulawesi Barat</div>
        </div>

        {{-- Konten --}}
        <div class="p-8">
            {{ $slot }}
        </div>
    </div>
</div>
@overwrite
