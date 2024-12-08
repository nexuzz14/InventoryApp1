@extends('layouts.dashboard')
@section('content')
    {{-- ! popup --}}
    <div class="top-0 left-0 z-40 fixed " x-data="formData">
        {{-- ! popup tambah  --}}
        <div x-show="show" style="position: fixed" x-transition:enter="animate__fadeIn animate__animated animate__faster"
            x-transition:leave="animate__fadeOut animate__animated animate__faster"
            class="box fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10  ">
            <div class="z-40 border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
                x-show="show" x-transition:enter="animate__fadeInUp animate__animated animate__faster"
                x-transition:leave="animate__fadeOutDown animate__animated animate__faster">


                <form action="{{ route('item.store') }}" method="POST" class="mt-3 w-full h-full flex flex-col"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="source" value="manual">
                    <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                    <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                        <div class="flex md:flex-col flex-row gap-2 pb-4">

                            {{-- group 1 --}}
                            <div class="section flex flex-col flex-1">
                                <label for="namaKategori">Nama Barang</label>
                                <input type="text" name="name"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" required />

                                <div class="flex gap-2 mb-[10px]">
                                    <div class="flex-1">
                                        <label for="supplier">Supplier</label>
                                        <select name="supplier_id" id="supplier"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <template x-for="supplier in suppliers">
                                                <option :value="supplier.id" x-text="supplier.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="category">Kategori</label>
                                        <select name="category_id" id="category"
                                            class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <template x-for="category in categories">
                                                <option :value="category.id" x-text="category.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <label for="location">Lokasi</label>
                                <select name="location_id" id="location"
                                    class="border px-2 w-full mt-2 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                    <template x-for="location in locations">
                                        <option :value="location.id" x-text="location.name"></option>
                                    </template>
                                </select>
                                <div class="flex gap-1">
                                    <div class="flex-1">
                                        <label for="quantity">Jumlah</label>
                                        <input type="number"
                                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                            id="quantity" name="quantity" required />
                                    </div>
                                    <div class="">
                                        <label for="unit">Satuan</label>
                                        <select name="unit_id" id="unit"
                                            class="border px-2 w-full mt-2 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                            <template x-for="unit in units">
                                                <option :value="unit.id" x-text="unit.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                </div>

                                <label for="status">Status</label>
                                <select name="status"
                                    class="border mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="status" required />
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

                                    <input id="fileInput" name="image" class="absolute w-full h-full opacity-0"
                                        type="file" accept="image/*" onchange="updateFileName(event)" required>
                                </div>
                                {{-- end input foto --}}



                                <label for="namaKategori">harga</label>
                                <input type="text" name="price"
                                    class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                    id="namaKategori" oninput="validateForm()" required />

                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                        <button type="reset" @click="show=false" onclick="resetFileName()"
                            class="bg-red-400 hover:bg-red-300 duration-200 rounded text-white px-2 py-2">Batal</button>
                        <button
                            class="button bg-green-400 hover:bg-green-300 duration-200 px-2 py-2 rounded text-white">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- ! end popup tambah  --}}



        {{-- ! popup btn --}}
        <button @click="openModal" x-show="!show"
            x-transition:enter="animate__fadeInRight animate__animated animate__faster"
            x-transition:leave="animate__fadeOutRight animate__animated  animate__faster"
            class="fixed group mb-2 flex overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white bottom-4 right-4 items-center cursor-pointer px-4">
            <div
                class="icons h-full w-10  bg-blue-400 group-hover:bg-blue-400 group-hover:w-full duration-200 flex items-center justify-center left-0 pl-4 absolute">
                <svg class="w-6 h-6 group-hover:rotate-90 duration-500 group-hover:scale-125 text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
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

    <div class="flex flex-wrap z-0" x-data="editData">
        <div class="box flex-1 px-3 py-2 md:max-w-full overflow-x-auto">
            <div class="card col-span-2 xl:col-span-1 px-2 md:max-w-full overflow-x-auto">
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
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td><img src="{{ Storage::url($item['image']) }}" style="width: 100px; height: 50px"
                                        alt=""></td>
                                <td>{{ $item['supplier'] }}</td>
                                <td>{{ $item['category'] }}</td>
                                <td>Jl. Kaliurang</td>
                                <td>{{ $item['quantity'] }} {{ $item['unit'] }}</td>
                                <td>Rp. {{ $item['price'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td class="">
                                    <div class="flex h-full items-center justify-center space-x-2">
                                        <button
                                            @click="openModal, 
                                            editData.name = '{{ $item['name'] }}', 
                                            editData.image = '{{ $item['image'] }}', 
                                            editData.quantity = '{{ $item['quantity'] }}', 
                                            editData.price = '{{ $item['price'] }}',
                                            editData.supplier = '{{ $item['supplier'] }}',
                                            editData.category = '{{ $item['category'] }}',
                                            editData.unit = '{{ $item['unit'] }}',
                                            editData.location = '{{ $item['location'] }}',
                                            editData.status = '{{ $item['status'] }}',
                                            editData.id = '{{ Crypt::encrypt($item['id']) }}'
                                            "
                                            class="text-green-500 px-2 py-2 rounded-md bg-green-100">Edit</button>
                                        <form action="{{ route('item.delete', ['id' => Crypt::encrypt($item['id'])]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 px-2 py-2 rounded-md bg-red-100">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div x-show="show">
            <strong x-text="editData.name"></strong>
        </div> --}}
        <div x-show="show"
            class="popup fixed top-0 left-0 z-40 h-screen w-screen bg-black bg-opacity-10 backdrop-blur-sm flex items-center justify-center">
            <div x-show="show" x-transition:enter="animate__fadeIn animate__animated  animate__faster"
                x-transition:leave="animate__fadeOut animate__animated  animate__faster"
                class="box fixed top-0 left-0 py-4 flex items-center px-2 justify-center backdrop-blur-sm w-screen h-screen bg-black bg-opacity-10 ">
                <div class=" border border-1  bg-white flex flex-col md:h-auto h-5/6 px-3 py-2 w-full max-w-[700px]"
                    x-show="show" x-transition:enter="animate__fadeInUp animate__animated animate__faster"
                    x-transition:leave="animate__fadeOutDown animate__animated  animate__faster">


                    <form action="{{ route('item.update') }}" method="POST" class="mt-3  w-full h-full  flex flex-col "
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" x-model="editData.id">
                        <p class="text-lg font-bold py-2 border-b border-1 flex-0 h-14">Tambah Barang</p>
                        <div class=" overflow-y-auto w-full px-2 mt-2 flex-1">
                            <div class="flex md:flex-col flex-row gap-2 pb-4">
                                <div class="section flex flex-col flex-1">
                                    <label for="namaKategori">Nama Barang</label>
                                    <input type="text" name="name" x-model="editData.name"
                                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="namaKategori" required />

                                    <div class="flex gap-2 mb-[10px]">
                                        <div class="flex-1">
                                            <label for="supplier">Supplier</label>
                                            <select name="supplier_id" id="supplier"
                                                class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                                <template x-for="supplier in suppliers">
                                                    <option :value="supplier.id" x-text="supplier.name"
                                                        x-bind:selected="editData.supplier == supplier.name"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="flex-1">
                                            <label for="category">Kategori</label>
                                            <select name="category_id" id="category"
                                                class="border px-3 w-full py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                                <template x-for="category in categories">
                                                    <option :value="category.id" x-text="category.name"
                                                        x-bind:selected="editData.category == category.name"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="location">Lokasi</label>
                                    <select name="location_id" id="location"
                                        class="border px-2 w-full mt-2 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                        <template x-for="location in locations">
                                            <option :value="location.id" x-text="location.name"
                                                x-bind:selected="editData.location == location.name"></option>
                                        </template>
                                    </select>
                                    <div class="flex gap-1">
                                        <div class="flex-1">
                                            <label for="quantity">Jumlah</label>
                                            <input type="number" x-model="editData.quantity"
                                                class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                                id="quantity" name="quantity" required />
                                        </div>
                                        <div class="">
                                            <label for="unit">Satuan</label>
                                            <select name="unit_id" id="unit"
                                                class="border px-2 w-full mt-2 py-2 active:ring-0 active:outline-none focus:outline-none focus-within:ring-0 rounded-md">
                                                <template x-for="unit in units">
                                                    <option :value="unit.id" x-text="unit.name"
                                                        x-bind:selected="editData.unit == unit.name"></option>
                                                </template>
                                            </select>
                                        </div>

                                    </div>

                                    <label for="status">Status</label>
                                    <select name="status"
                                        class="border mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="status" required />
                                    <option value="tersedia" x-bind:selected="editData.status == 'tersedia'">Tersedia
                                    </option>
                                    <option value="tidak tersedia" x-bind:selected="editData.status == 'tidak tersedia'">
                                        Tidak
                                        Tersedia
                                    </option>
                                    </select>

                                </div>

                                <div class="flex flex-col flex-1">
                                    <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-[138px] mt-2 mb-2"
                                        id="previewContainerEdit">
                                        <img id="imagePreviewEdit" :src="'{{ Storage::url('') }}' + editData.image"
                                            alt="Image preview" class="w-full h-full object-contain">
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

                                        <p style="" id="fileNameEdit"
                                            class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">
                                            Select File</p>

                                        <input id="fileInput" class="absolute w-full h-full opacity-0" type="file"
                                            accept="image/*" name="image" onchange="updateFileNameEdit(event)">
                                    </div>



                                    <label for="harga">harga</label>
                                    <input x-model="editData.price" type="text" name="price"
                                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-2 rounded focus:outline-none focus-within:ring-0"
                                        id="harga" oninput="validateForm()" required />

                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 font-bold justify-end w-full flex-0 h-14 py-2 border-t">
                            <button type="reset" @click="show=false" onclick="resetFileNameEdit()"
                                class="bg-red-400 hover:bg-red-300 duration-200 rounded text-white px-2 py-2">Batal</button>
                            <button
                                class="button bg-green-400 hover:bg-green-300 duration-200 px-2 py-2 rounded text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('formData', () => ({
                show: false,
                categories: [],
                suppliers: [],
                units: [],
                locations: [],
                openModal() {
                    this.fetchData()
                    this.show = true
                },
                closeModal() {
                    this.show = false
                },
                fetchData() {
                    fetch('/form-options', {
                            method: "GET",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.categories = data.categories
                            this.suppliers = data.suppliers
                            this.units = data.units
                            this.locations = data.locations
                        })
                        .catch(error => console.error('Error:', error));
                }
            }))
            Alpine.data('editData', () => ({
                show: false,
                editData: {
                    name: '',
                    image: '',
                    supplier: '',
                    category: '',
                    location: '',
                    quantity: '',
                    unit: '',
                    price: '',
                    status: '',
                    id: ''
                },
                categories: [],
                suppliers: [],
                units: [],
                locations: [],
                openModal() {
                    this.fetchData()
                    this.show = true
                },
                closeModal() {
                    this.show = false
                },
                fetchData() {
                    fetch('/form-options', {
                            method: "GET",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.categories = data.categories
                            this.suppliers = data.suppliers
                            this.units = data.units
                            this.locations = data.locations
                        })
                        .catch(error => console.error('Error:', error));
                }
            }))
        })

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
            fileNameDisplay.textContent = "Select File"
        }

        function resetFileName() {
            const fileNameDisplay = document.getElementById('fileName');
            const previewContainer = document.getElementById('previewContainer');

            previewContainer.style.display = 'none';
            fileNameDisplay.textContent = "Select File";

        }
    </script>

    <!-- End Recent Sales -->
@endsection
