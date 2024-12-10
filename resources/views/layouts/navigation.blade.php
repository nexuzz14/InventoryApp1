<div class="tailwind-scope">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 drop-shadow-md w-full z-50 fixed overflow-visible">
        <div class=""
            :class="openNav ? 'flex justify-between z-50 h-12 pr-5 overflow-visible' :
                'flex flex-wrap justify-between items-center z-50 h-12 pr-5 overflow-visible'">
            <div class="flex justify-start items-center">
                <button id="toggleSidebar" aria-expanded="true" aria-controls="sidebar"
                    class="hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h14M1 6h14M1 11h7" />
                    </svg>
                </button>
                <button aria-expanded="true" aria-controls="sidebar" onclick="toggleSidebar()"
                    class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                    <span class="sr-only">Toggle sidebar</span>
                </button>
                <a href="#" class="flex mr-4">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">Inventory</span>
                </a>
                <form action="#" method="GET" class="hidden lg:block lg:pl-2">
                    <label for="topbar-search" class="sr-only">Search</label>
                    <div class="relative mt-1 lg:w-96">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="email" id="topbar-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-9 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search">
                    </div>
                </form>
            </div>
            <div class=""
                :class="openNav ? 'flex items-center justify-end lg:order-2' : 'flex items-center justify-center lg:order-2'">
                <button type="button" @click="openNav = !openNav"
                    class="flex text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 absolute"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
                <!-- Dropdown menu -->

                @if (Auth::user())
                    <div :class="openNav ? 'fixed top-14 right-0' : 'hidden'"
                        class="z-50 my-4  text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown">
                        <div class="py-3 px-4">
                            @auth
                                <span
                                    class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span
                                    class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            @endauth
                        </div>
                        {{-- <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                            profile</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                            settings</a>
                    </li>
                </ul> --}}

                        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="/auth/logout"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                                    out</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="px-3 py-1 bg-blue text-white font-medium text-lg" href="{{route('login')}}">Login</a>
                @endif
            </div>
        </div>
    </nav>
</div>
