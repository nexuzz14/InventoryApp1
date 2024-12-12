@extends('layouts.dashboard')
@section('content')
    <div x-data="{ show: false, name: '', id: '' }" class="tailwind-scope">
        <div class="flex flex-wrap gap-2">
            <div class="flex-1 p-2 w-full bg-white shadow rounded-md">
                <table id="table" class="mt-10">
                    <thead>
                        <tr>
                            <th class="w-14 text-xs lg:text-md">#</th>
                            <th class="text-xs lg:text-md">lokasi</th>
                            <th class="w-20 pl-4 text-xs lg:text-md">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr class="bg-white  hover:bg-gray-50">
                                <td class="text-xs lg:text-md">{{ $no++ }}</td>
                                <td class="text-xs lg:text-md">{{ $item->name }}</td>
                                <td class="flex space-x-2">
                                    <button @click="show=true, name='{{ $item->name }}', id='{{ Crypt::encrypt($item->id) }}'"
                                        class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</button>
                                    <form action="{{ route('location.delete', ['id' => Crypt::encrypt($item->id)]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex-0 w-full lg:max-w-96">
                <div class="form w-full bg-white border border-1 px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Tambah lokasi</p>
                    <form action="{{ route('location.store') }}" method="POST" id="locationForm" class="flex mt-3 flex-col">
                        @csrf
                        <label for="name">Nama Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="name"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="name" required>

                        <div class="flex items-end w-full justify-end">
                            <input type="submit" value="Submit"
                                class="submit-button hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ! popup --}}
        <div x-show="show" x-transition:enter="animate__animated animate__fadeIn animate__faster"
            x-transition:leave="animate__animated animate__fadeOut animate__faster"
            class="fixed w-screen h-screen bg-black bg-opacity-10 backdrop-blur-sm top-0 left-0 flex items-center justify-center">
            <div x-show="show" x-transition:enter="animate__animated animate__fadeInUp animate__faster"
                x-transition:leave="animate__animated animate__fadeOutDown animate__faster"
                class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Edit lokasi</p>
                    <form action="{{ route('location.update') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        @method('PATCH')
                        <label for="namaKategori">Nama lokasi</label>

                        <input type="hidden" x-model="id" name="id">
                        <input type="text" name="name" x-model="name"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="name">


                        <div class="flex gap-2 items-end w-full justify-end">
                            <button @click="show=!show" type="button"
                                class=" bg-red-400 text-white rounded px-2 hover:px-4 py-1 duration-200">Batal</button>
                            <input type="submit"
                                class="hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                            </input>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('locationForm').addEventListener('submit', function(event) {
            const submitButton = this.querySelector('.submit-button');
            // Disable button to prevent double submit
            submitButton.disabled = true;
            submitButton.classList.add('bg-gray-300', 'cursor-not-allowed'); // Optional: Add styles for disabled state
        });
    </script>
@endsection
