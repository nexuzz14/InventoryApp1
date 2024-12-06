@extends('layouts.dashboard')
@section('content')
    <div class="flex flex-wrap" x-data="{ show: false, name: '', id: '', address: '', phone: '' }">
        <div class="box flex-1  px-3 py-2">
            <div class="card col-span-2 xl:col-span-1 px-4">
                <div class="card-header">Kategori</div>
                <table id="table" class="">
                    <thead>
                        <tr>
                            <th class="w-14">#</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th class="w-20 ">
                                <p class="w-full text-center">Aksi</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->phone }}</td>
                                <td class="flex items-center justify-center space-x-2">
                                    <button
                                        @click="show=true, name='{{ $item->name }}', address='{{ $item->address }}', phone='{{ $item->phone }}', id='{{ Crypt::encrypt($item->id) }}'"
                                        class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</button>
                                    <form action="{{route('supplier.delete', ['id' => Crypt::encrypt($item->id)])}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit"
                                            class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex-0   px-3 py-2 w-full max-w-96">
            <div class="form  w-full  bg-white border border-1  px-3 py-2">
                <p class="text-lg font-bold py-2 border-b border-1">Tambah Supllier</p>
                <form action="{{ route('supplier.create') }}" method="POST" class="flex mt-3 flex-col">
                    @csrf
                    <label for="namaKategori">Nama Supplier</label>
                    <input type="text" name="name"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaKategori" oninput="validateForm()" required />

                    <label for="notelp">No. Telepon Supplier</label>
                    <input type="text" name="phone"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="notelp" oninput="validateForm()" required />
                    <small id="error-message" style="color: red; display: none;">Nomor telepon tidak valid. Harus berupa
                        angka dengan panjang 10-15 karakter.</small>

                    <label for="alamat">Alamat Supplier</label>
                    <input type="text" name="address"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="alamat" oninput="validateForm()" required />

                    <div class="flex items-end w-full justify-end">
                        <button id="submit-button"
                            class="bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
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

        <div x-show="show" x-transition:enter="animate__animated animate__fadeIn animate__faster"
            x-transition:leave="animate__animated animate__fadeOut animate__faster"
            class="popupEdit z-40 w-screen h-screen bg-black bg-opacity-10 backdrop-blur-sm flex items-center justify-center fixed top-0 left-0">
            <div class="flex-0   px-3 py-2 w-full max-w-96">
                <div x-show="show" x-transition:enter="animate__animated animate__fadeInUp animate__faster"
                    x-transition:leave="animate__animated animate__fadeOutDown animate__faster"
                    class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Edit Supllier</p>
                    <form action="{{ route('supplier.update') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        @method('PATCH')
                        <label for="namaEdit">Nama Supplier</label>
                        <input type="hidden" x-model='id' name="id">
                        <input type="text"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="namaEdit" oninput="validateFormEdit()" name="name" required x-model="name" />

                        <label for="notelpEdit">No. Telepon Supplier</label>
                        <input type="text"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="notelpEdit" oninput="validateForm()" name="phone" required x-model="phone" />
                        <small id="error-messageEdit" style="color: red; display: none;">Nomor telepon tidak valid. Harus
                            berupa
                            angka dengan panjang 10-15 karakter.</small>

                        <label for="alamatEdit">Alamat Supplier</label>
                        <input type="text"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none mt-2 px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="alamatEdit" x-model="address" name="address" oninput="validateForm()" required />

                        <div class="flex items-end w-full justify-end gap-2">
                            <button type="reset" @click="show=false"
                                class="bg-red-400 px-2 hover:px-4 duration-200 py-1 text-white rounded">Batal </button>
                            <button type="submit" id="submit-buttonEdit"
                                class="bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                                Update
                            </button>
                        </div>



                        <script>
                            function validateFormEdit() {
                                const namaKategori = document.getElementById('namaKategoriEdit').value.trim();
                                const notelp = document.getElementById('notelpEdit').value.trim();
                                const alamat = document.getElementById('alamatEdit').value.trim();
                                const errorMessage = document.getElementById('error-messageEdit');
                                const submitButton = document.getElementById('submit-buttonEdit');
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
    </div>

    <!-- End Recent Sales -->
@endsection
