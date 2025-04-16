<header class="sticky top-0 z-999 flex w-full bg-white shadow-md shadow-gray-200">
    <div class="flex flex-grow items-center justify-between px-6 py-2">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button
                class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm lg:hidden"
                @click.stop="sidebarToggle = !sidebarToggle">
                <x-icons.hero name="bars-3" size="w-5 h-5" />
                <span class="relative block h-5.5 w-5.5 cursor-pointer">
                    <span class="du-block absolute right-0 h-full w-full">
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-300': !sidebarToggle }"></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-400': !sidebarToggle }"></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-500': !sidebarToggle }"></span>
                    </span>
                    <span class="du-block absolute right-0 h-full w-full rotate-45">
                        <span
                            class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!h-0 delay-[0]': !sidebarToggle }"></span>
                        <span
                            class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                            :class="{ '!h-0 dealy-200': !sidebarToggle }"></span>
                    </span>
                </span>
            </button>
           <a class="block flex-shrink-0 w-8 lg:hidden" href="{{ route('dashboard') }}">
                <img src="{{ secure_asset('public/files/logo_2.ico') }}" alt="Logo" class="rounded">
            </a>
        </div>

        {{-- Identitas Satker --}}
        <div class="mr-4 mt-1 text-sm leading-3 sm:leading-6">{{ $satker ?? null }}</div>

        <div class="flex items-center gap-3 2xsm:gap-7">
            {{-- Untuk penambahan icon lihat tailadmin --}}

            <!-- User Area -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false" x-cloak>
                <a class="flex items-center gap-4" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
                    <div class="hidden text-right lg:block">
                        <span class="block text-sm font-medium text-black">{{ auth()->user()->nama }}</span>
                        <span class="block text-xs font-medium">{{ auth()->user()->email }}</span>
                    </div>

                    <span class="h-12 w-12 rounded-full">
                        <img src="{{ secure_asset('public/files/user-01.png') }}" alt="user" />
                    </span>

                    <x-icons.hero name="chevron-down" size="w-4 h-4" />
                </a>

                <!-- Dropdown Start -->
                <div
                    x-show="dropdownOpen"
                    class="absolute right-0 mt-2 flex w-fit flex-col rounded-lg border border-stroke bg-white shadow-default">
                    <ul class="border-b border-stroke px-6 py-2">
                        <li>
                            @livewire('auth.logout')
                        </li>
                    </ul>
                </div>
                <!-- Dropdown End -->
            </div>
            <!-- User Area -->

        </div>
    </div>
</header>
