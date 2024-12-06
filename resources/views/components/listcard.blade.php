<div class="tailwind-scope">
    <div class="w-full max-w-md p-4 sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">List barang dengan stok kurang dari
                10</h5>
            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                View all
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @for ($i = 0; $i < 5; $i++)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center ">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full">
                                <div
                                    class="bg-red-100 w-full h-full rounded-full flex items-center justify-center text-white text-sm">
                                    1
                                </div>
                            </div>
                            <div class="flex-1 min-w-0 ms-4 ml-2">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Kertas
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Kategori: Alat Tulis
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                $320
                            </div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </div>

</div>
