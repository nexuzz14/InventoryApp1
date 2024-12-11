<div class="tailwind-scope">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 drop-shadow-md w-full z-50 fixed overflow-visible">
        <div class=""
            :class="openNav ? 'flex justify-between z-50 h-12 pr-5 overflow-visible' :
                'flex flex-wrap justify-between items-center z-50 h-12 pr-5 overflow-visible'">
            <div class="flex justify-start items-center">
                {{-- <button id="toggleSidebar" aria-expanded="true" aria-controls="sidebar"
                    class="hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h14M1 6h14M1 11h7" />
                    </svg>
                </button> --}}
                <button aria-expanded="true" aria-controls="sidebar" onclick="toggleSidebar()"
                    class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer {{Auth::check() ? (Auth::user()->role === 'user' ? '' : 'lg:hidden') : 'lg:hidden'}} hover:text-gray-900 hover:bg-gray-100  focus:ring-2  dark:focus:ring-0 dark:text-gray-400  dark:hover:text-white">
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
                {{-- <form action="#" method="GET" class="hidden lg:block lg:pl-2">
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
                </form> --}}
            </div>
            <div class=""
                :class="openNav ? 'flex items-center justify-end lg:order-2' : 'flex items-center justify-center lg:order-2'">


                @if (Auth::check())
                @if (Auth::user()->role === "user")
                <a href="/chart" class="chart px-3">
                    <svg class="w-8 h-8 text-gray-800 hover:text-gray-400 duration-150" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
                      </svg>
                      
                </a>
                @endif
            
                    <button type="button" @click="openNav = !openNav"
                        class="flex text-sm bg-gray-800 rounded-full md:mr-0  focus:ring-0"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                    <div :class="openNav ? 'fixed top-14 right-2' : 'hidden'"
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
                    <a class="px-3 py-1 bg-blue-400 rounded text-white font-medium text-lg"
                        href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>
</div>
