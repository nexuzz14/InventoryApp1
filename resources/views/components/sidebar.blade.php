<!-- start sidebar -->
<div id="sidebar"
    class="relative flex flex-col lg:mt-0 bg-white border-r border-gray-300 p-6 flex-none w-64  {{ Auth::check() ? (Auth::user()->role === 'user' ? '-ml-64' : 'lg:ml-0 md:-ml-64') : 'lg:ml-0 md:-ml-64' }} md:fixed md:top-0 md:z-30 h-full shadow-xl animate__animated animate_faster  text-sm ">
    <div x-data="{ isHovered: false }" x-on:mouseenter="isHovered = true" x-on:mouseleave="isHovered = false"
        class="flex-0 pb-6 border-b w-full  iconGroup mt-16 md:pt-8 relative">
        <a href="/auth/logout" class="absolute top-0 right-0">
            <x-mdi-logout class="w-6 h-6 "></x-mdi-logout>
        </a>
        <div class="flex flex-col gap-2 items-center">

            <div class="box w-16 h-16 p-2 box-content shadow-md rounded-full border-2 overflow-hidden">
                <lord-icon src="https://cdn.lordicon.com/fmasbomy.json" :trigger="isHovered ? 'in' : 'morph'"
                    state="hover-looking-around" class="w-16 h-16">
                </lord-icon>
            </div>
            <div class="flex flex-col justify-center text-center w-full">
                <h5 class="line-clamp-1 font-medium">{{ Auth::user()->username }}</h5>
                <h5 class="line-clamp-1 text-red-500">{{ Auth::user()->email }}</h5>
            </div>
        </div>
    </div>
    <div class=" flex-1 overflow-y-auto scrollsimple w-full">
        <div class="flex flex-col h-full flex-1 w-full">
            <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
                <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                    <p class="uppercase text-xs text-gray-600  tracking-wider">Home</p>
                    <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                            clip-rule="evenodd" />
                    </svg>


                </button>
                <!-- link -->
                <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                    x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster" href="/dashboard"
                    class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                    <x-mdi-chart-pie class="mr-2 w-6 h-6" />
                    Analytics dashboard
                    <a />
            </div>

            @auth
                @if (Auth::user()->role != 'user')
                    <div x-data="{ show: false }" class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
                        <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                            <p class="uppercase text-xs text-gray-600  tracking-wider">Master Data</p>
                            <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </button>


                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/category"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-vector-arrange-below class="mr-2 w-6 h-6" />
                            Kategori
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="{{ route('satuan') }}"
                            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-scale-balance class="mr-2 w-6 h-6" />
                            Satuan
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/supplier"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-account-multiple class="mr-2 w-6 h-6" />
                            Supplier
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/lokasi"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-store-marker-outline class="mr-2 w-6 h-6" />
                            Lokasi
                        </a>

                    </div>
                @endif

            @endauth

            <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
                <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                    <p class="uppercase text-xs text-gray-600  tracking-wider">Transaksi</p>
                    <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                            clip-rule="evenodd" />
                    </svg>


                </button>

                @auth
                    @if (Auth::user()->role != 'user')
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="./typography.html"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-clipboard-check-outline class="mr-2 w-6 h-6" />
                            Permintaan Barang
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/barang"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-cube-outline class="mr-2 w-6 h-6" />
                            Barang
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/pembelian"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-cart class="mr-2 w-6 h-6" />
                            Pembelian
                        </a>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="./alert.html"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-cart-minus class="mr-2 w-6 h-6" />
                            Barang Keluar
                        </a>
                        
                    @endif
                    <a x-show="show"
                            x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="/dashboard/invoice"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <svg class="mr-2 w-6 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>invoice-multiple-outline</title><path d="M2 2V17H4V4H17V2H2M18.5 20.32L21 22V6H6V22L8.5 20.32L11 22L13.5 20.32L16 22L18.5 20.32M19 8V17.57L16 19.59L13.5 17.9L11 19.59L8 17.57V8H19Z" /></svg>
                            invoice
                        </a>
                @endauth

            </div>

            @auth
                @if (Auth::user()->role == 'superadmin')
                    <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
                        <button @click="show=!show"
                            class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                            <p class="uppercase text-xs text-gray-600  tracking-wider">User Management</p>
                            <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </button>
                        <!-- link -->
                        <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                            x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                            href="{{ route('pengguna') }}"
                            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                            <x-mdi-chart-pie class="mr-2 w-6 h-6" />
                            Account
                        </a>
                    </div>
                @endif
            @endauth


        </div>
    </div>



</div>
<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden"></div>
