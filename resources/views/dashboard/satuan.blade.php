@extends('layouts.dashboard')
@section('content')
    <!-- Start Recent Sales -->
    <div class="flex flex-wrap">
        <div class="box flex-1  px-3 py-2">
            <div class="searchBox flex gap-2 w-full  border py-2 px-3 border-1 rounded bg-white">
                <svg class="w-6 h-6  mt-1 text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Z" />
                    <path fill-rule="evenodd"
                        d="M21.707 21.707a1 1 0 0 1-1.414 0l-3.5-3.5a1 1 0 0 1 1.414-1.414l3.5 3.5a1 1 0 0 1 0 1.414Z"
                        clip-rule="evenodd" />
                </svg>
                <form action="" class="w-full gap-2 flex">
                    <input type="text"
                        class="pl-2 bg-gray-200 active:ring-0 flex-1 active:outline-none focus:outline-none focus-within:ring-0 w-full py-1 rounded-md"
                        placeholder="Cari Supplier..">
                    <button class="flex-0 w-20 bg-blue-400 rounded-md text-white px-2">Cari</button>
                </form>
            </div>
            <div class="card col-span-2 xl:col-span-1 mt-3">
                <div class="card-header">Kategori</div>

                <table class="table-auto w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border border-l-0">No</th>

                            <th class="px-4 py-2 border-r">Nama Supplier</th>
                            <th class="px-4 py-2 border-r">Alamat</th>

                            <th colspan="2" class=" py-2 text-center border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">

                        <tr class="hover:bg-gray-200  duration-200">
                            <td class="px-4 py-2 border border-l-0">
                                1
                            </td>
                            <td class="border  px-4 py-2">
                                <p class="line-clamp-1">Gus miftah asdasdas asdas asda asd asd </p>
                            </td>
                            <td class="border px-4 py-2 ">
                                <p class="line-clamp-1">Gus miftah asdasdas asdas asda asd asd </p>
                            </td>


                            <td class="border border-l-0 border-r-0 text-center  px-4 py-2">
                                <svg class="w-6 h-6 text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </td>
                            <td class="border text-center border-l-0 px-4 py-2">
                                <svg class="w-6 h-6 text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </td>

                        </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex-0   px-3 py-2 w-full max-w-96">
            <div class="form  w-full  bg-white border border-1  px-3 py-2">
                <p class="text-lg font-bold py-2 border-b border-1">Tambah Satuan</p>
                <form action="" class="flex mt-3 flex-col">
                    <label for="namaKategori">Nama Satuan</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                   

                    <div class="flex items-end w-full justify-end">
                        <button id="submit-button"
                            class="bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded" >
                            tambah
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
