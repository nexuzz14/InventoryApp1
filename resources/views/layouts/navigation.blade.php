<div class="tailwind-scope">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 drop-shadow-md w-full z-50 fixed overflow-visible">
        <div class=""
            :class="openNav ? 'flex justify-between z-50 h-12 pr-5 overflow-visible' :
                'flex flex-wrap justify-between items-center z-50 h-12 pr-5 overflow-visible'">
            <div class="flex justify-start items-center">
               
                <button aria-expanded="true" aria-controls="sidebar" onclick="toggleSidebar()"
                    class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer {{ Auth::check() ? (Auth::user()->role === 'user' ? '' : 'lg:hidden') : 'lg:hidden' }} hover:text-gray-900 hover:bg-gray-100  focus:ring-2  dark:focus:ring-0 dark:text-gray-400  dark:hover:text-white">
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
               
            </div>
            <div class=""
                :class="openNav ? 'flex items-center justify-end lg:order-2' : 'flex items-center justify-center lg:order-2'">


                @if (Auth::check())
                    @if (Auth::user()->role === 'user')
                        <a href="/chart" class="chart px-3">
                            <x-mdi-cart-outline class="text-black w-8 h-8" />
                        </a>
                    @endif

                  
                @else
                    <a class="px-3 py-1 bg-blue-400 rounded text-white font-medium text-lg"
                        href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>
</div>
