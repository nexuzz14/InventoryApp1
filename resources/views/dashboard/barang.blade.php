@extends('layouts.dashboard')
@section('content')
    {{-- ! popup --}}
    <style>
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna overlay */
            z-index: 1040;
            /* Pastikan lebih tinggi dari elemen lain */
        }

        .modal {
            z-index: 1050;
            /* Modal harus berada di atas overlay */
        }
    </style>
    <div class="popup fixed w-screen h-screen top-0 left-0 z-30" x-data="{ show: false }">
        {{-- ! popup tambah  --}}
        <div x-show="show" x-transition:enter="animate__fadeIn animate__animated"
            x-transition:leave="animate__fadeOut animate__animated"
            class="box fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10  ">
            <div class=" border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
                x-show="show" x-transition:enter="animate__fadeInUp animate__animated"
                x-transition:leave="animate__fadeOutDown animate__animated">


                <form action="" class="mt-3  w-full h-full  flex flex-col ">
                    <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                    <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                        <div class="flex md:flex-col flex-row gap-2 pb-4">

                            {{-- group 1 --}}
                            <div class="section flex flex-col flex-1">
                                <label for="namaKategori">Nama Barang</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                                <div class="flex gap-2 mb-[10px]">
                                    <div class="flex-1">
                                        <label for="namaKategori">Supplier</label>
                                        <select name="supplier" id="supplier"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <option value="">Indomater</option>
                                            <option value="">Indomater</option>
                                            <option value="">Indomater</option>

                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="namaKategori">Source</label>
                                        <select name="source" id="source"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <option value="purchases">Purchases</option>
                                            <option value="manual">Manual</option>
                                        </select>

                                    </div>
                                </div>
                                <label for="namaKategori">Lokasi</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                                <label for="namaKategori">Status</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                            </div>

                            {{-- group 2 --}}
                            <div class="flex flex-col flex-1">
                                {{-- input foto --}}
                                <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-32 mt-2 mb-2"
                                    id="previewContainer" style="display: none;">
                                    <img id="imagePreview" src="" alt="Image preview"
                                        class="w-full h-full object-contain">
                                </div>
                                <label for="fileInput">Gambar</label>
                                <div
                                    class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                                    <svg class="w-6 z-0 h-6 text-white absolute" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <!-- Text will be replaced with file name -->
                                    <p style="" id="fileName"
                                        class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
                                        Select File</p>

                                    <input id="fileInput" class="absolute w-full h-full opacity-0" type="file"
                                        accept="image/*" onchange="updateFileName(event)">
                                </div>
                                {{-- end input foto --}}



                                <label for="namaKategori">harga</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                        <button type="button" @click="show=false"
                            class="bg-red-400 hover:bg-red-300 duration-200 rounded text-white px-2 py-2">Batal</button>
                        <button
                            class="button bg-green-400 hover:bg-green-300 duration-200 px-2 py-2 rounded text-white">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- ! end popup tambah  --}}



        {{-- ! popup btn --}}
        <button @click="show=true" x-show="!show"
            x-transition:enter="animate__fadeInRight animate__animated animate__faster"
            x-transition:leave="animate__fadeOutRight animate__animated  animate__faster"
            class="fixed group mb-2 flex overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white bottom-4 right-4 items-center cursor-pointer px-4">
            <div
                class="icons h-full w-10  bg-blue-400 group-hover:bg-blue-400 group-hover:w-full duration-200 flex items-center justify-center left-0 pl-4 absolute">
                <svg class="w-6 h-6 group-hover:rotate-90 duration-500 group-hover:scale-125 text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd" />
                </svg>
            </div>


            <p style="" id="fileName" class="pl-8  line-clamp-1 text-white  flex-1 w-full">
                Tambah Barang</p>


        </button>
        {{-- ! end popup button --}}
    </div>
    {{-- ! end popup --}}

    <div class="flex flex-wrap">
        <div class="box flex-1  px-3 py-2">
            <div class="searchBox flex gap-2 w-full  border py-2 px-3 border-1 rounded bg-white">
                <svg class="w-6 h-6  mt-1 text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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
            <div class="card col-span-2 xl:col-span-1 mt-3 px-2">
                <div class="card-header">Kategori</div>

                <table id="table" class="table-auto w-full text-left">
                    <thead>
                        <th>Nama Barang</th>
                        <th>Image</th>
                        <th>Supplier</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pensil</td>
                            <td><img src="https://picsum.photos/100/50" alt=""></td>
                            <td>Gus Miftah</td>
                            <td>Alat Tulis</td>
                            <td>Gudang, Jl. Kaliurang</td>
                            <td>10 pcs</td>
                            <td>Rp. 10.000 / pcs</td>
                            <td>Tersedia</td>
                            <td class="">
                                <div class="flex h-full items-center justify-center space-x-2">
                                    <a href="" class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</a>
                                    <a href="" class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <script>
        // Function to update file name when file is selected
        function updateFileName(event) {
            const fileInput = event.target;
            const fileNameDisplay = document.getElementById('fileName');
            const imagePreview = document.getElementById('imagePreview');
            const previewContainer = document.getElementById('previewContainer');

            // Ensure only one file is selected and it's an image
            if (fileInput.files && fileInput.files[0] && fileInput.files[0].type.startsWith('image/')) {
                const file = fileInput.files[0];
                fileNameDisplay.textContent = file.name;

                // Create a URL for the selected image and set it as the src of the preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block'; // Show the preview container
                };
                reader.readAsDataURL(file); // Read the file as a data URL to preview
            } else {
                fileNameDisplay.textContent = 'Please select an image file';
                previewContainer.style.display = 'none'; // Hide the preview if no valid file is selected
            }
        }
    </script>
    {{-- ! popup Edit  --}}
    <div x-show="show" x-transition:enter="animate__fadeIn animate__animated"
        x-transition:leave="animate__fadeOut animate__animated"
        class="box hidden fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10  ">
        <div class=" border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
            x-show="show" x-transition:enter="animate__fadeInUp animate__animated"
            x-transition:leave="animate__fadeOutDown animate__animated">


            <form action="" class="mt-3  w-full h-full  flex flex-col ">
                <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                    <div class="flex md:flex-col flex-row gap-2 pb-4">

                        {{-- group 1 --}}
                        <div class="section flex flex-col flex-1">
                            <label for="namaKategori">Nama Barang</label>
                            <input type="text"
                                class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                id="namaKategori" oninput="validateForm()" required />

                            <div class="flex gap-2 mb-[10px]">
                                <div class="flex-1">
                                    <label for="namaKategori">Supplier</label>
                                    <select name="supplier" id="supplier"
                                        class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                        <option value="">Indomater</option>
                                        <option value="">Indomater</option>
                                        <option value="">Indomater</option>

                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label for="namaKategori">Source</label>
                                    <select name="source" id="source"
                                        class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                        <option value="purchases">Purchases</option>
                                        <option value="manual">Manual</option>
                                    </select>

                                </div>
                            </div>
                            <label for="namaKategori">Lokasi</label>
                            <input type="text"
                                class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                id="namaKategori" oninput="validateForm()" required />

                            <label for="namaKategori">Status</label>
                            <input type="text"
                                class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                id="namaKategori" oninput="validateForm()" required />

                        </div>

                        {{-- group 2 --}}
                        <div class="flex flex-col flex-1">
                            {{-- input foto --}}
                            <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-32 mt-2 mb-2"
                                id="previewContainer" style="display: none;">
                                <img id="imagePreview" src="" alt="Image preview"
                                    class="w-full h-full object-contain">
                            </div>
                            <label for="fileInput">Gambar</label>
                            <div
                                class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                                <svg class="w-6 z-0 h-6 text-white absolute" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <!-- Text will be replaced with file name -->
                                <p style="" id="fileName"
                                    class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
                                    Select File</p>

                                <input id="fileInput" class="absolute w-full h-full opacity-0" type="file"
                                    accept="image/*" onchange="updateFileName(event)">
                            </div>
                            {{-- end input foto --}}



                            <label for="namaKategori">harga</label>
                            <input type="text"
                                class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                id="namaKategori" oninput="validateForm()" required />

                        </div>
                    </div>
                </div>
                <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                    <button type="button" @click="show=false"
                        class="bg-red-400 hover:bg-red-300 duration-200 rounded text-white px-2 py-2">Batal</button>
                    <button
                        class="button bg-green-400 hover:bg-green-300 duration-200 px-2 py-2 rounded text-white">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    {{-- ! end popup EDIT  --}}
    <!-- End Recent Sales -->
@endsection
