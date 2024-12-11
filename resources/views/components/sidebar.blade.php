<!-- start sidebar -->
<div id="sidebar"
    class="relative flex lg:mt-0 bg-white border-r border-gray-300 p-6 flex-none w-64 lg:ml-0 md:-ml-64 md:fixed md:top-0 md:z-30 h-full shadow-xl animated faster text-sm overflow-y-auto scrollsimplea">
    <!-- Semua ikon akan menggunakan ukuran text-sm -->

    <!-- sidebar content -->
    <div class="flex md:mt-16 flex-col w-full">
        <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
            <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                <p class="uppercase text-xs text-gray-600  tracking-wider">Home</p>
                <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                        clip-rule="evenodd" />
                </svg>
                <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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

        <div x-data="{ show: false }" class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
            <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                <p class="uppercase text-xs text-gray-600  tracking-wider">Master Data</p>
                <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                        clip-rule="evenodd" />
                </svg>
                <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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
        <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
            <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
                <p class="uppercase text-xs text-gray-600  tracking-wider">Transaksi</p>
                <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                        clip-rule="evenodd" />
                </svg>
                <svg class="w-6 h-6 text-gray-800 " x-show="show" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                        clip-rule="evenodd" />
                </svg>


            </button>

            <!-- link -->
            <a x-show="show" x-transition:enter="animate__animated animate__lightSpeedInLeft animate__faster"
                x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster"
                href="/dashboard/permintaan-barang"
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
                x-transition:leave="animate__animated animate__lightSpeedOutLeft animate__faster" href="./alert.html"
                class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
                <x-mdi-cart-minus class="mr-2 w-6 h-6" />
                Barang Keluar
            </a>
        </div>



        <div x-data={show:false} class="flex flex-col mt-3 w-full border-b-2 border-gray-200">
            <button @click="show=!show" class="flex gap-2 border-none mb-4 w-full justify-between items-center">
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
    </div>
</div>
<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden"></div>
