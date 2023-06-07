@extends('layouts.base')

@section('content')
    <div class="flex flex-col">
        <div class="flex h-screen flex-col">
            <div class="flex-shrink-0 md:flex">
                <div class="flex items-center justify-between bg-primary-500 px-6 py-3 md:w-56 md:flex-shrink-0 md:justify-center">
                    <a href="/">
                        <div class="w-full fill-white">
                            @include('components.logo.logo', [
                                'width' => 150,
                                'height' => 36.728,
                            ])
                        </div>
                    </a>
                    {{-- Mobile View --}}
                    <div class="md:hidden" x-data="{ open: false }">
                        <div @click="open = true">
                            <svg class="h-6 w-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </div>
                        <ul class="absolute right-0 z-50 mt-2 rounded bg-primary-500 px-8 py-4 text-right shadow-lg sm:mr-32" x-show="open"
                            @click.away="open = false">
                            <li><button wire:click="archive">Archive</button></li>
                            <li><button wire:click="delete">Delete</button></li>
                        </ul>
                        <div class="fixed bottom-0 left-0 right-0 top-0 z-10 bg-black opacity-25" x-show="open"></div>
                    </div>
                </div>
                <div class="md:text-md flex w-full items-center justify-between border-b bg-white p-4 text-sm md:px-12 md:py-0">
                    <div class="mr-4 mt-1">{{ $satker ?? null }}</div>
                    {{-- Dropdown --}}
                    <div class="mt-1" x-data="{ open: false }">
                        <div class="group flex cursor-pointer select-none items-center" @click="open = true">
                            <div class="mr-2 whitespace-nowrap text-gray-700 focus:text-primary-500 group-hover:text-primary-500">
                                <span class="hidden md:inline">{{ $nama }}</span>
                            </div>
                            <img class="-my-2 block h-6 w-6 rounded-full"
                                src="{{ $foto ?? 'https://www.clipartmax.com/png/small/6-61698_lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-avatar-login.png' }}">
                            <div class="w-5"></div>
                        </div>
                        <ul x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                            class="absolute right-0 z-50 mr-4 mt-2 rounded bg-white py-2 text-right text-sm shadow md:mr-16 lg:mr-16"
                            @click.away="open = false">
                            <li class="block cursor-pointer px-6 py-2 hover:bg-primary-500 hover:text-white">
                                @livewire('auth.logout')
                            </li>
                        </ul>
                        <div class="fixed bottom-0 left-0 right-0 top-0 z-10 bg-black opacity-25" x-show="open"></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-grow overflow-hidden">
                <div class="hidden w-56 flex-shrink-0 overflow-y-auto bg-gradient-to-b from-primary-500 to-fuchsia-700 py-12 pl-10 md:block">
                    @include('partials.menu')
                </div>
                <div class="flex-1 overflow-y-auto px-4 py-8 md:p-12" scroll-region>
                    {{--
                <flash-messages /> --}}
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@overwrite
