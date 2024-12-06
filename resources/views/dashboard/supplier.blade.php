@extends('layouts.dashboard')
@section('content')
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
            <div class="card col-span-2 xl:col-span-1 mt-3 px-4">
                <div class="card-header">Kategori</div>

                <table id="table" class="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gus Miftah</td>
                            <td>Jl. Kaliurang</td>
                            <td class="flex items-center justify-center space-x-2">
                                <a href="" class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</a>
                                <a href="" class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex-0   px-3 py-2 w-full max-w-96">
            <div class="form  w-full  bg-white border border-1  px-3 py-2">
                <p class="text-lg font-bold py-2 border-b border-1">Tambah Supllier</p>
                <form action="" class="flex mt-3 flex-col">
                    <label for="namaKategori">Nama Supplier</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                    <label for="notelp">No. Telepon Supplier</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="notelp" oninput="validateForm()" required />
                    <small id="error-message" style="color: red; display: none;">Nomor telepon tidak valid. Harus berupa
                        angka dengan panjang 10-15 karakter.</small>

                    <label for="alamat">Alamat Supplier</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="alamat" oninput="validateForm()" required />

                    <div class="flex items-end w-full justify-end">
                        <button id="submit-button"
                            class="bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded" >
                            tambah
                        </button>
                    </div>

                    

                    <script>
                        function validateForm() {
                            const namaKategori = document.getElementById('namaKategori').value.trim();
                            const notelp = document.getElementById('notelp').value.trim();
                            const alamat = document.getElementById('alamat').value.trim();
                            const errorMessage = document.getElementById('error-message');
                            const submitButton = document.getElementById('submit-button');
                            const phoneRegex = /^[0-9]{10,15}$/; // Hanya angka, panjang 10-15 karakter

                            // Validasi nomor telepon
                            if (!phoneRegex.test(notelp)) {
                                errorMessage.style.display = 'block';
                            } else {
                                errorMessage.style.display = 'none';
                            }

                            // Aktifkan tombol jika semua input valid
                            if (namaKategori && phoneRegex.test(notelp) && alamat) {
                                submitButton.disabled = false;
                            } else {
                                submitButton.disabled = true;
                            }
                        }
                    </script>

                </form>
            </div>
        </div>
    </div>

    <!-- End Recent Sales -->
@endsection
