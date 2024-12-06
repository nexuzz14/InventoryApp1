<!-- start sidebar -->
<div id="sidebar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 lg:ml-0 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster text-sm">
    <!-- Semua ikon akan menggunakan ukuran text-sm -->

    <!-- sidebar content -->
    <div class="flex flex-col">

        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">homes</p>

        <!-- link -->
        <a href="/dashboard"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-chart-pie class="mr-2 w-6 h-6" />
            Analytics dashboard
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Master Data</p>

        <!-- link -->
        <a href="/dashboard/category"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-vector-arrange-below class="mr-2 w-6 h-6" />
            Kategori
        </a>
        <!-- link -->
        <a href="/dashboard/category"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-scale class="mr-2 w-6 h-6" />
            Satuan
        </a>
        <!-- link -->
        <a href="/dashboard/supplier"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-account-multiple class="mr-2 w-6 h-6" />
            Supplier
        </a>
        <!-- link -->
        <a href="/dashboard/barang"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-cube-outline class="mr-2 w-6 h-6" />
            Barang
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Transaksi</p>

        <!-- link -->
        <a href="./typography.html"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-clipboard-check-outline class="mr-2 w-6 h-6" />
            Permintaan Barang
        </a>
        <!-- link -->
        <a href="./alert.html"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-cart-minus class="mr-2 w-6 h-6" />
            Barang Keluar
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">User Managemen</p>
        <!-- link -->
        <a href="./alert.html"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-shield-key-outline class="mr-2 w-6 h-6" />
            Akses / Permission
        </a>
        <!-- link -->
        <a href="./alert.html"
            class="mb-3 capitalize font-medium hover:text-teal-600 transition ease-in-out duration-500 flex items-center">
            <x-mdi-account-key-outline class="mr-2 w-6 h-6" />
            Role
        </a>
    </div>
</div>
<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden"></div>
