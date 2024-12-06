@extends('layouts.dashboard')
@section('content')
    <div class="tailwind-scope">

        <div class="flex flex-wrap">

            <div class="flex-1 px-3 py-2 w-full bg-white shadow rounded-md">
                <table id="table" class="mt-10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($categories as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="flex space-x-2">
                                    <a href="" class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</a>
                                    <a href="{{ route('category.delete', ['id' =>  Crypt::encrypt($item->id)]) }}"
                                        class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Tambah Kategori</p>
                    <form action="{{ route('category.create') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" name="name"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="name">
                        <div
                            class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                        </div>

                        <div class="flex items-end w-full justify-end">
                            <input type="submit"
                                class="hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                            </input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
        });
    </script>
@endsection
