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
        <div class="w-full bg-primary-600 h-14">
            <a class="text-white"
                x-bind:class="$store.sidebar.full ? 'text-2xl px-4' : 'text-xl px-4 xm:px-2'">
                LOGO
            </a>
        </div>

        <div class="h-screen">
            @include('components.menu')
        </div>
    </div>

    <div class="w-screen">
        {{-- Topbar --}}
        <div class="h-14 bg-white border-b md:px-8 text-sm flex justify-between items-center">
            <div>BPS Provinsi Sulawesi Barat</div>
            {{-- Dropdown --}}
            {{-- <div class="mt-1" x-data="{ open: false }">
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
            </div> --}}
        </div>

        {{-- Konten --}}
        <div class="p-8">
            {{ $slot }}
        </div>
    </div>
</div>
@overwrite
