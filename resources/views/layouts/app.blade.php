@extends('layouts.base')

@section('content')
<div class="h-screen flex">
    {{-- Mobile menu toggle --}}
    <button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen"
       class="sm:hidden absolute top-5 right-5 focus:outline-none">
        {{-- Menu icon --}}
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            x-bind:class="$store.sidebar.navOpen ? 'hidden':''"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
        {{-- Close menu --}}
        <svg x-cloak
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            x-bind:class="$store.sidebar.navOpen ? '':'hidden'"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Sidebar --}}
    <div class=" h-full bg-primary-500 transition-all duration-300 space-y-2 fixed sm:relative"
        x-bind:class="{'w-64':$store.sidebar.full, 'w-64 sm:w-20':!$store.sidebar.full,'top-0 left-0':$store.sidebar.navOpen,'top-0 -left-64 sm:left-0':!$store.sidebar.navOpen}">

        {{-- Logo Aplikasi --}}
        <div class="w-full bg-primary-600 h-14">
            <a href="/" class="fill-white"
                x-bind:class="$store.sidebar.full ? 'text-2xl px-4' : 'text-xl px-4 xm:px-2'">
                <div class="w-32 fill-white">@include('components.logo')</div>
            </a>
        </div>

        @include('components.menu')
    </div>

    <div class="w-screen">
        {{-- Topbar --}}
        <div class="h-14 bg-white border-b md:px-8 text-sm flex justify-between items-center">
            <div>BPS Provinsi Sulawesi Barat</div>
            {{-- Dropdown --}}
            <div class="mt-1" x-data="{ open: false }">
                <div class="flex items-center cursor-pointer select-none group" @click="open = true">
                    <img class="block w-6 h-6 rounded-full mr-2 -my-2" src="" alt="Profil">
                    <div class="text-gray-700 group-hover:text-primary-500 focus:text-primary-500 mr-1 whitespace-no-wrap">
                        <span class="hidden md:inline">Admin</span>
                    </div>
                    <div class="w-5 h-5 group-hover:fill-primary-500 fill-gray-700 focus:fill-primary-500">
                        @include('components.icon', ['name' => 'chevron-down', 'size' => 'w-5 h-5'])
                    </div>
                </div>
                <ul class="sm:mr-4 md:mr-12 lg:mr-12 text-right right-0 mt-2 py-2 shadow bg-white rounded text-sm absolute z-50" x-show.transition.duration.50ms="open" @click.away="open = false">
                    <li class="block px-6 py-2 hover:bg-primary-500 hover:text-white">
                        @livewire('auth.logout')
                    </li>
                </ul>
                <div class="fixed bg-black opacity-25 top-0 left-0 right-0 bottom-0 z-10" x-show="open"></div>
            </div>
        </div>

        {{-- Konten --}}
        <div class="p-8">
            {{ $slot }}
        </div>
    </div>
</div>
@overwrite

@push('scripts')
<script>
    // Custom Alpine Sidebar
    document.addEventListener('alpine:init', () => {
    // Stores variable globally
    Alpine.store('sidebar', {
        full: false,
        active: 'home',
        navOpen: false
    });
    // Creating component Dropdown
    Alpine.data('dropdown', () => ({
        open: false,
        toggle(tab) {
            this.open = !this.open;
            Alpine.store('sidebar').active = tab;
        },
        activeClass: 'bg-gray-800 text-gray-200',
        expandedClass: 'border-l border-gray-400 ml-4 pl-4',
        shrinkedClass: 'sm:absolute top-0 left-20 sm:shadow-md sm:z-10 sm:bg-gray-900 sm:rounded-md sm:p-4 border-l sm:border-none border-gray-400 ml-4 pl-4 sm:ml-0 w-28'
    }));
    // Creating component Sub Dropdown
    Alpine.data('sub_dropdown', () => ({
        sub_open: false,
        sub_toggle() {
            this.sub_open = !this.sub_open;
        },
        sub_expandedClass: 'border-l border-gray-400 ml-4 pl-4',
        sub_shrinkedClass: 'sm:absolute top-0 left-28 sm:shadow-md sm:z-10 sm:bg-gray-900 sm:rounded-md sm:p-4 border-l sm:border-none border-gray-400 ml-4 pl-4 sm:ml-0 w-28'
    }));
    // Creating tooltip
    Alpine.data('tooltip', () => ({
        show: false,
        visibleClass:'block sm:absolute -top-7 sm:border border-gray-800 left-5 sm:text-sm sm:bg-gray-900 sm:px-2 sm:py-1 sm:rounded-md'
    }))
})
</script>
@endpush
