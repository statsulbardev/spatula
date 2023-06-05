@extends('layouts.base')

@section('content')
    <div class="flex">
        {{-- Mobile menu toggle --}}
        <button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen"
                class="absolute right-5 top-5 focus:outline-none sm:hidden">
            {{-- Menu icon --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 x-bind:class="$store.sidebar.navOpen ? 'hidden' : ''"
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
                 class="h-5 w-5"
                 x-bind:class="$store.sidebar.navOpen ? '' : 'hidden'"
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
        <div class="fixed space-y-2 bg-primary-500 transition-all duration-300 sm:relative"
             x-bind:class="{
                 'w-64': $store.sidebar.full,
                 'w-64 sm:w-20': !$store.sidebar.full,
                 'top-0 left-0': $store.sidebar
                     .navOpen,
                 'top-0 -left-64 sm:left-0': !$store.sidebar.navOpen
             }">

            {{-- Logo Aplikasi --}}
            <div class="flex h-14 w-full items-center justify-center bg-primary-600"
                 x-data="{ show: false }">
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
            <div class="flex h-14 items-center justify-between border-b bg-white text-sm md:px-8">
                <div class=""></div>
                <div x-data="{ open: false }">
                    <div class="group flex cursor-pointer select-none items-center"
                         @click="open = true">
                        <div
                             class="whitespace-no-wrap mr-4 text-gray-700 focus:text-primary-500 group-hover:text-primary-500">
                            <span class="hidden md:inline">{{ auth()->user()->nama }}</span>
                        </div>
                        <img class="h-6 w-6 rounded-full"
                             src="{{ $photo ?? null }}">
                    </div>
                    <ul class="absolute right-0 z-50 mt-2 rounded bg-white py-2 text-right text-sm shadow sm:mr-4 md:mr-12 lg:mr-12"
                        x-show.transition.duration.50ms="open"
                        @click.away="open = false">
                        <li class="block px-6 py-2 hover:bg-primary-500 hover:text-white">
                            @livewire('auth.logout')
                        </li>
                    </ul>
                    <div class="fixed bottom-0 left-0 right-0 top-0 z-10 bg-black opacity-25"
                         x-show="open"></div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="p-4 lg:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
@overwrite
