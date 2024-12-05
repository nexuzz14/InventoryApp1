@extends('layouts.dashboard')
@section('content')
    <div
        class="box fixed top-0 z-10 left-0 flex items-center justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10 p-4 overflow-y-auto">
        <div class=" max-h-full   px-3 py-2 w-full max-w-96">
            <div class="form  w-full h-full  bg-white border border-1  px-3 py-2">
                <p class="text-lg font-bold py-2 border-b border-1">Tambah Barang</p>
                <form action="" class="flex mt-3 flex-col max-h-full overflow-y-auto">
                    <label for="namaKategori">Nama Barang</label>
                    <input type="text" 
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                    <label for="namaKategori">Supplier</label>
                    <select name="supplier" id="supplier" class="border px-3 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                        <option value="">Indomater</option>
                        <option value="">Indomater</option>
                        <option value="">Indomater</option>

                    </select>

                    <label for="namaKategori">Lokasi</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                    <label for="namaKategori">Status</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                    <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-32 mt-2 mb-2"
                        id="previewContainer" style="display: none;">
                        <img id="imagePreview" src="" alt="Image preview" class="w-full h-full object-contain">
                    </div>
                    <label for="fileInput">Gambar</label>
                    <div
                        class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                        <svg class="w-6 z-0 h-6 text-white absolute" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                clip-rule="evenodd" />
                        </svg>

                        <!-- Text will be replaced with file name -->
                        <p style="" id="fileName"
                            class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
                            Select File</p>

                        <input id="fileInput" class="absolute w-full h-full opacity-0" type="file" accept="image/*"
                            onchange="updateFileName(event)">
                    </div>

                    <label for="namaKategori">Source</label>
                    <select name="source" id="source" class="border px-3 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                        <option value="purchases">Purchases</option>
                        <option value="manual">Manual</option>

                    </select>
                    <label for="namaKategori">harga</label>
                    <input type="text"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

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
                    <div class="btnGroup" class="flex gap-2  text-white font-bold">
                        <button type="button" class="bg-red-400 w-full">Batal</button>
                        <button class="button bg-green-400 w-full  ">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div
        class="fixed mb-2 flex overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white bottom-4 right-4 items-center cursor-pointer px-4">
        <svg class="w-6 h-6 z-0 absolute text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                clip-rule="evenodd" />
        </svg>


        <!-- Text will be replaced with file name -->
        <p style="" id="fileName"
            class="hover:pl-2 pl-8  line-clamp-1 z-10 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
            Tambah Barang</p>


    </div>
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
    <!-- End Recent Sales -->
@endsection
