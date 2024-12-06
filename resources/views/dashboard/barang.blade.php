@extends('layouts.dashboard')
@section('content')
    {{-- ! popup --}}
    <div class="top-0 left-0 z-40  fixed " x-data="{ show: false }">
        {{-- ! popup tambah  --}}
        <div x-show="show" style="position: fixed" x-transition:enter="animate__fadeIn animate__animated animate__faster"
            x-transition:leave="animate__fadeOut animate__animated animate__faster"
            class="box fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10  ">
            <div class="z-40 border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
                x-show="show" x-transition:enter="animate__fadeInUp animate__animated animate__faster"
                x-transition:leave="animate__fadeOutDown animate__animated animate__faster">


                <form action="" class="mt-3  w-full h-full  flex flex-col ">
                    <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                    <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                        <div class="flex md:flex-col flex-row gap-2 pb-4">

                            {{-- group 1 --}}
                            <div class="section flex flex-col flex-1">
                                <label for="namaKategori">Nama Barang</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori"  required />

                                <div class="flex gap-2 mb-[10px]">
                                    <div class="flex-1">
                                        <label for="supplier">Supplier</label>
                                        <select name="supplier" id="supplier"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <option value="">Indomater</option>
                                            <option value="">Indomater</option>
                                            <option value="">Indomater</option>

                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="source">Source</label>
                                        <select name="source" id="source"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <option value="purchases">Purchases</option>
                                            <option value="manual">Manual</option>
                                        </select>

                                    </div>
                                </div>
                                <label for="lokasi">Lokasi</label>
                                <input type="text"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="lokasi"  required />

                                <label for="status">Status</label>
                                <select
                                class="border mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                id="status"  required />
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak">Tidak Tersedia</option>
                            </select>

                            </div>

                            {{-- group 2 --}}
                            <div class="flex flex-col flex-1">
                                {{-- input foto --}}
                                <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-[138px] mt-2 mb-2"
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
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                        <button type="reset"  @click="show=false" onclick="resetFileName()"
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


            <p style="" id="fileName" class="pl-8  line-clamp-1 text-white  flex-1 w-full"> Tambah Barang </p>

        </button>
        {{-- ! end popup button --}}
    </div>
    {{-- ! end popup --}}

    <div class="flex flex-wrap z-0" x-data="{ show: false, editData: { name: '', supplier: '', source: '', lokasi: '', status: '', gambar: '', harga: '' } }">
        <div class="box flex-1  px-3 py-2">
            <div class="card col-span-2 xl:col-span-1 px-2">
                <div class="card-header">Kategori</div>

                <table id="table" class="">
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
                                    <button @click="show = true, editData={name:'pensil', supllier:'indomater', source:'manual', lokasi:'ringroad', status:'tersedia', gambar:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQDE4cJvMUaRNtQKS6pJCi7je2_72uwO5USw&s', harga:'10.000'}" class="text-green-500 px-2 py-2 rounded-md bg-green-100">Edit</button>
                                    <a href="" class="text-red-500 px-2 py-2 rounded-md bg-red-100">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div x-show="show" class="popup fixed top-0 left-0 z-40 h-screen w-screen bg-black bg-opacity-10 backdrop-blur-sm flex items-center justify-center">
            {{-- ! popup Edit  --}}
            <div x-show="show" x-transition:enter="animate__fadeIn animate__animated  animate__faster"
                x-transition:leave="animate__fadeOut animate__animated  animate__faster"
                class="box fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10 ">
                <div class=" border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
                    x-show="show" 
                    x-transition:enter="animate__fadeInUp animate__animated animate__faster"
                    x-transition:leave="animate__fadeOutDown animate__animated  animate__faster">


                    <form action="" class="mt-3  w-full h-full  flex flex-col ">
                        <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                        <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                            <div class="flex md:flex-col flex-row gap-2 pb-4">

                                {{-- group 1 --}}
                                <div class="section flex flex-col flex-1">
                                    <label for="nama">Nama Barang</label>
                                    <input x-model="editData.name" type="text"
                                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="nama"  required />

                                    <div class="flex gap-2 mb-[10px]">
                                        <div class="flex-1">
                                            <label for="sup">Supplier</label>
                                            <select x-model="editData.supplier" name="supplier" id="sup"
                                                class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                                <option value="">Indomater</option>
                                                <option value="">Indomater</option>
                                                <option value="">Indomater</option>

                                            </select>
                                        </div>
                                        <div class="flex-1">
                                            <label for="sourcei">Source</label>
                                            <select x-model="editData.source" name="source" id="source"
                                                class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                                <option value="purchases">Purchases</option>
                                                <option value="manual">Manual</option>
                                            </select>

                                        </div>
                                    </div>
                                    <label for="lokasi">Lokasi</label>
                                    <input x-model="editData.lokasi"  type="text"
                                        class="bg-gray-200 mb-2  active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="lokasi" required />

                                    <label for="status">Status</label>
                                    <select x-model="editData.status"
                                        class="border mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="status"  required />
                                            <option value="tersedia">Tersedia</option>
                                            <option value="tidak">Tidak Tersedia</option>
                                    </select>

                                </div>

                                {{-- group 2 --}}
                                <div class="flex flex-col flex-1">
                                    {{-- input foto --}}
                                    <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-[138px] mt-2 mb-2"
                                        id="previewContainerEdit" >
                                        <img id="imagePreviewEdit" :src="editData.gambar" alt="Image preview"
                                            class="w-full h-full object-contain">
                                    </div>
                                    <label for="fileInput">Gambar</label>
                                    <div
                                        class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-[10px] rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                                        <svg class="w-6 z-0 h-6 text-white absolute" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <!-- Text will be replaced with file name -->
                                        <p style="" id="fileNameEdit"
                                            class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
                                            Select File</p>

                                        <input id="fileInput" class="absolute w-full h-full opacity-0" type="file"
                                            accept="image/*" onchange="updateFileNameEdit(event)">
                                    </div>
                                    {{-- end input foto --}}



                                    <label for="harga">harga</label>
                                    <input x-model="editData.harga" type="text"
                                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="harga" oninput="validateForm()" required />

                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                            <button type="reset" @click="show=false" onclick="resetFileNameEdit()"
                                class="bg-red-400 hover:bg-red-300 duration-200 rounded text-white px-2 py-2">Batal</button>
                            <button
                                class="button bg-green-400 hover:bg-green-300 duration-200 px-2 py-2 rounded text-white">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- ! end popup EDIT  --}}
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
        function updateFileNameEdit(event) {
            const fileInput = event.target;
            const fileNameDisplay = document.getElementById('fileNameEdit');
            const imagePreview = document.getElementById('imagePreviewEdit');
            const previewContainer = document.getElementById('previewContainerEditEdit');

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

        function resetFileNameEdit() { 
            const fileNameDisplay = document.getElementById('fileNameEdit');
            fileNameDisplay.textContent="Select File"
         }
         function resetFileName() { 
            const fileNameDisplay = document.getElementById('fileName');
            const previewContainer = document.getElementById('previewContainer');

            previewContainer.style.display = 'none';
            fileNameDisplay.textContent="Select File";

         }
    </script>

    <!-- End Recent Sales -->
@endsection
