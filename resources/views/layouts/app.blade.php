@extends('layouts.base')

@section('content')
<div class="flex flex-col">
    <div class="h-screen flex flex-col">
        <div class="md:flex flex-shrink-0">
            <div class="bg-primary-500 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
                <a class="mt-1" href="/">
                    <div class="w-32 fill-white">LOGO</div>
                </a>
                {{-- Mobile View --}}
                <div class="md:hidden" x-data="{ open: false }">
                    <div @click="open = true">
                        <svg class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                    </div>
                    <ul class="sm:mr-32 mt-2 text-right right-0 px-8 py-4 shadow-lg bg-primary-500 rounded absolute z-50" x-show="open" @click.away="open = false">
                        <li><button wire:click="archive">Archive</button></li>
                        <li><button wire:click="delete">Delete</button></li>
                    </ul>
                    <div class="fixed bg-black opacity-25 top-0 left-0 right-0 bottom-0 z-10" x-show="open"></div>
                </div>
            </div>
            <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
                <div class="mt-1 mr-4">BPS Provinsi Sulawesi Barat</div>
                {{-- Dropdown --}}
                <div class="mt-1" x-data="{ open: false }">
                    <div class="flex items-center cursor-pointer select-none group" @click="open = true">
                        <img class="block w-6 h-6 rounded-full mr-2 -my-2" src="{{ $photo ?? null }}">
                        <div class="text-gray-700 group-hover:text-primary-500 focus:text-primary-500 mr-1 whitespace-no-wrap">
                            <span class="hidden md:inline">{{ $name ?? null }}</span>
                        </div>
                        <div class="w-5 h-5 group-hover:fill-primary-500 fill-gray-700 focus:fill-primary-500">
                            {{-- @include('components.icon', ['name' => 'cheveron-down']) --}}
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
        </div>
        <div class="flex flex-grow overflow-hidden">
            <div class="bg-gradient-to-b from-primary-500 to-indigo-500 flex-shrink-0 w-56 pl-10 py-12 hidden md:block overflow-y-auto">
                @include('partials.menu')
            </div>
            <div class="flex-1 px-4 py-8 md:p-12 overflow-y-auto" scroll-region>
                {{-- <flash-messages /> --}}
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
@overwrite
