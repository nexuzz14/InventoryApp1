@extends('layouts.dashboard')
@section('content')
    <div  x-data="{ show: false , editData:{name:'', id:''}}" class="tailwind-scope">
        <div class="flex flex-wrap">
            <div class="flex-1 px-3 py-2 w-full bg-white shadow rounded-md">
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
                        {{-- @foreach ($categories as $item) --}}
                            <tr class="bg-white  hover:bg-gray-50">
                                <td class="text-xs lg:text-md">1</td>
                                <td class="text-xs lg:text-md">Kilo</td>
                                <td class="flex space-x-2">
                                    <button @click="show=true, editData={name: 'Kilo', id: '1'}" class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</button>
                                    <a href=""
                                        class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</a>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Tambah lokasi</p>
                    <form action="{{ route('category.create') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        <label for="namaKategori">Nama Lokasi</label>
                        <input type="text" name="name"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="name">


                        <div class="flex items-end w-full justify-end">
                            <input type="submit"
                                class="hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                            </input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ! popup --}}
        <div x-show="show"
            x-transition:enter="animate__animated animate__fadeIn animate__faster"
            x-transition:leave="animate__animated animate__fadeOut animate__faster"

            class="fixed w-screen h-screen bg-black bg-opacity-10 backdrop-blur-sm top-0 left-0 flex items-center justify-center">
            <div
            x-show="show"
             x-transition:enter="animate__animated animate__fadeInUp animate__faster"
            x-transition:leave="animate__animated animate__fadeOutDown animate__faster"
             class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Edit lokasi</p>
                    <form action="{{ route('category.create') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        <label for="namaKategori">Nama lokasi</label>

                        <input type="hidden" x-model="editData.id">
                        <input type="text" name="name"  x-model="editData.name"
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


    {{-- <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
        });
    </script> --}}
@endsection
