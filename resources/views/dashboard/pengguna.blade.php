@extends('layouts.dashboard')
@section('content')
    <x-notivication-handler :message="session('message')"></x-notivication-handler>


    <div x-data="{ show: false, editData: { username: '', nama:'', email:'', role:'', id: '' } }" class="tailwind-scope">

        <div class="flex flex-wrap">
            <div class="box flex-1 w-full">

                {{-- tombol pisah --}}
                <div class="btn_group flex gap-2 py-2">
                    <a href="/dashboard/pengguna/user" 
                        class="py-2 px-2 rounded border duration-200 hover:px-3 
                        {{ request()->is('dashboard/pengguna/user') ? 'px-4 bg-blue-200 text-blue-600' : '' }}">
                        Customer
                    </a>
                    <a href="/dashboard/pengguna/admin" 
                        class="py-2 px-2 rounded border duration-200 hover:px-3 
                        {{ request()->is('dashboard/pengguna/admin') ? 'px-4 bg-blue-200 text-blue-600' : '' }}">
                        Petugas
                    </a>
                </div>
                
                {{-- end tombol pisah --}}

                {{-- table --}}
                <div class=" px-3 py-2 w-full bg-white shadow rounded-md">
                    <table id="table" class="mt-10">
                        <thead>
                            <tr>
                                <th class="w-14 text-xs lg:text-md">#</th>
                                <th class="text-xs lg:text-md">Nama</th>
                                <th class="text-xs lg:text-md">Nama Pengguna</th>
                                <th class="text-xs lg:text-md">Email</th>

                                <th class="w-20 pl-4 text-xs lg:text-md">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($user as $item)
                            <tr class="bg-white  hover:bg-gray-50">
                                <td class="text-xs lg:text-md">{{$no++}}</td>
                                <td class="text-xs lg:text-md">{{$item->name}}</td>
                                <td class="text-xs lg:text-md">{{$item->username}}</td>
                                <td class="text-xs lg:text-md">{{$item->email}}</td>
                                <td class="flex space-x-2">
                                    <button @click="show=true, editData={username: '{{$item->username}}', nama: '{{$item->name}}', email: '{{$item->email}}', role: '{{$item->role}}', id: '{{Crypt::encrypt($item->id)}}'}"
                                        class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</button>
                                    <form method="POST" action="{{route('pengguna.delete', ['id'=> Crypt::encrypt($item->id)])}}">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- end table --}}

            </div>

            {{-- tambah data --}}
            <div class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Tambah pengguna</p>
                    <form action="{{ route('pengguna.store') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        <label for="username">Nama pengguna</label>
                        <input type="text" name="username"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="username" required>
                            @error('username')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror

                        <label for="nama">Nama</label>
                        <input type="text" name="name"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="nama" required>
                            @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror

                        <label for="email">Email</label>
                        <input type="email" name="email"
                            class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                            id="email" required>
                            @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        <label for="role">Role</label>
                        <select name="role" id="role" required
                            class="mb-2 border active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0">
                            <option value="admin">Petugas</option>
                            <option value="user">pengguna</option>
                        </select>
                        @error('role')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror

                        <div class="passwordInput" x-data="{ showPass: false }">
                            <label for="password">Password</label>
                            <div class="inputBox mb-2 flex gap-2 bg-gray-200">
                                <input :type="showPass ? 'text' : 'password'" name="password"
                                    class="bg-gray-200 active:ring-0 flex-1 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                    id="password" required>
                                <button @click="showPass = !showPass" type="button"
                                    class="flex justify-center w-10 flex-0  items-center py-2">
                                    <svg x-show="!showPass" class="w-6 h-6 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                                        <path
                                            d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                                        <path
                                            d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                                    </svg>
                                    <svg x-show="showPass" class="w-6 h-6" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>


                            </div>
                        </div>
                        @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <div class="flex items-end w-full mt-3 justify-end gap-2">
                            <input type="submit"
                                class="hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                            </input>
                        </div>
                    </form>
                </div>
            </div>

            {{-- endTambahData --}}
        </div>

        {{-- ! popup edit  --}}
        <div x-show="show"  x-transition:enter="animate__animated animate__fadeIn animate__faster"
            x-transition:leave="animate__animated animate__fadeOut animate__faster"
            class="fixed w-screen h-screen px-4 bg-black bg-opacity-10 backdrop-blur-sm top-0 left-0 flex items-center justify-center">

            <div 
                x-show="show"
                x-transition:enter="animate__animated animate__faster animate__fadeInUp"
                x-transition:leave="animate__animated animate__faster animate__fadeOutDown"

             class="form  w-full max-w-96   bg-white border border-1  px-3 py-2">
                <p class="text-lg font-bold py-2 border-b border-1">Edit pengguna</p>
                <form action="" method="POST" class="flex mt-3 flex-col">
                    @csrf
                    @method("PATCH")

                    <input type="hidden" name="id" x-model="editData.id">
                    <label for="usernameEd">Nama pengguna</label>
                    <input type="text" name="data[username]" x-model="editData.username"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="usernameEd" required>
                    
                    <label for="namaEd">Nama</label>
                    <input type="text" name="data[name]" x-model="editData.nama"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="namaEd" required>

                    <label for="emailEd">Email</label>
                    <input type="email" name="data[email]" x-model="editData.email"
                        class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                        id="emailEd" required>

                    <label for="roleEd">Role</label>
                    <select name="data[role]" id="roleEd" required x-model="editData.role"
                        class="mb-2 border active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0">
                        <option value="admin">Petugas</option>
                        <option value="customer">pengguna</option>
                    </select>

                    <div class="passwordInput" x-data="{ showPass: false }">
                        <label for="passwordEd">Password</label>
                        <div class="inputBox mb-2 flex gap-2 bg-gray-200">
                            <input :type="showPass ? 'text' : 'password'" name="data[password]"
                                class="bg-gray-200 active:ring-0 flex-1 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0"
                                id="passwordEd" >
                            <button @click="showPass = !showPass" type="button"
                                class="flex justify-center w-10 flex-0  items-center py-2">
                                <svg x-show="!showPass" class="w-6 h-6 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                                    <path
                                        d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                                    <path
                                        d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                                </svg>
                                <svg x-show="showPass" class="w-6 h-6" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </button>


                        </div>
                    </div>

                    <div class="flex items-end w-full mt-3 justify-end gap-2">
                        <button @click="show=false" type="button" class="bg-red-400 text-white rounded px-2 py-1 hover:px-4 duration-200">Batal</button>

                        <input type="submit"
                            class="hover:cursor-pointer bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                        </input>
                    </div>
                </form>
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
