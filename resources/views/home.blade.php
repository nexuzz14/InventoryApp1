@extends('layouts.app')
@section('content')
    <!-- Main Content -->
    <main x-data="{ show: false }" class="max-w-7xl mx-auto py-10 px-6 space-y-12">
        <!-- Welcome Section -->
        <section class="flex md:flex-col flex-row items-center gap-8">
            <div class="md:w-1/2 ">
                <h2 class="text-4xl font-bold mb-4">Selamat Datang di Inventory App</h2>
                <p class="text-gray-400">Kelola produk dan persediaan Anda dengan mudah menggunakan platform kami yang ramah pengguna.
                    Tetap terorganisir dan hemat waktu dengan fitur-fitur canggih kami.</p>
            </div>
            <div class="md:w-1/2 h-96 overflow-hidden flex items-center md:justify-end justify-center">
                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                <dotlottie-player class="w-96 scale-125 h-96"
                    src="https://lottie.host/61b33a14-a550-40b1-939e-fa3bf50da3f0/bvXfIAUAgV.lottie" background="transparent"
                    speed="1" loop autoplay></dotlottie-player>
            </div>
        </section>


        <section>
            <h3 class=" mb-6 flex gap-3">
                <p class="text-3xl font-bold">Daftar Produk</p>
                <button @click="show=true"
                    class="capitalize border-l-2 hover:shadow-lg duration-150 border-blue-500 rounded px-3 py-1  bg-blue-100 text-blue-600 flex  items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-inherit min-w-20">Semua Kategori</p>
                </button>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @isset($barang)
                    @foreach ($barang as $item)
                        <a href="/order/{{ Crypt::encrypt($item['id']) }}"
                            class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                            <img src="{{ Storage::url($item['image']) }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h4 class="text-lg font-medium">{{ $item['name'] }}</h4>
                                <h6 class="text-gray-400">
                                    Rp. {{ number_format($item['price'], 0, ',', '.') }}
                                </h6>
                            </div>
                        </a>
                    @endforeach
                @endisset



            </div>
        </section>
        {{-- ! popup kategori --}}
        <div x-show="show" x-transition:enter="animate__animated animate__faster animate__fadeIn"
            x-transition:leave="animate__animated animate__faster animate__fadeOut"
            class="fixed w-screen h-screen flex p-4 items-center justify-center top-0 left-0 backdrop-brightness-50 z-40">
            <div x-show="show" x-transition:enter="animate__animated animate__faster animate__fadeInUp"
                x-transition:leave="animate__animated animate__faster animate__fadeOutDown"
                class=" bg-white border min-h-96 min-w-96  md:w-full lg:w-fit border-gray-200 rounded-md shadow-md  max-w-full p-2">
                <div class="header flex items-center gap-4 border-b-2 justify-between w-full py-2 ">
                    <h4 class="text-lg font-bold">
                        Kategori Barang
                    </h4>
                    <button @click="show=false" class="text-white bg-red-400 py-1 px-2 ">
                        Batal
                    </button>
                </div>
                <div class="box py-2 flex flex-wrap gap-2">
                    <a href="/"
                        class="px-3 py-1 rounded-full capitalize border bg-blue-100 text-blue-700 whitespace-nowrap border-blue-400 hover:shadow-lg duration-200">Semua
                        Kategori</a>
                    @isset($category)
                        @foreach ($category as $item)
                            <a href="/barang/{{ Crypt::encrypt($item['id']) }}"
                                class="px-3 py-1 rounded-full capitalize border bg-blue-100 text-blue-700 whitespace-nowrap border-blue-400 hover:shadow-lg duration-200">{{ $item->name }}</a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </main>
@endsection
