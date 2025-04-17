<header class="sticky flex justify-center  top-0 z-999 flex w-full bg-white shadow-sm dark:bg-boxdark dark:drop-shadow-none">
    <div class="flex px-4 py-1 md:px-6 2xl:px-11 w-full lg:w-3/4">
        <div  class="flex items-center leading-3 sm:leading-6 font-medium">
            SPATULA ANTRIAN
        </div>
        <div class="flex grow"></div>
        <div class="flex items-center gap-3 2xsm:gap-7">
            <!-- User Area -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false" x-cloak>
                <a class="flex items-center gap-4" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
                    <div class="text-right lg:block">
                        <div class="text-sm font-medium text-black leading-3 sm:leading-6">
                            {{ session('konsumen_nama') }}
                        </div>
                    </div>

                    <span class="h-9 w-9 flex flex-nowrap items-center rounded-full">
                        {{-- <img src="https://www.clipartmax.com/png/small/6-61698_lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-avatar-login.png" alt="user" /> --}}
                        <img class="rounded-full" src="{{ session('konsumen_avatar_url') }}" alt="user" />
                    </span>

                    <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block" width="12"
                        height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                            fill="" />
                    </svg>
                </a>

                <!-- Dropdown Start -->
                <div x-show="dropdownOpen"
                    class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7.5 dark:border-strokedark py-5">
                        <li>
                            <div>
                                <a href="{{route('antrian-non-admin-auth-logout')}}"
                                    class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                    @include('components.icon', ['name' => 'logout', 'size' => 'w-6 h-6'])
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Dropdown End -->
            </div>
            <!-- User Area -->

        </div>
    </div>
</header>
