@extends('layouts.dashboard')
@section('content')
    <div x-data="initializeData">
        <div class="flex flex-wrap gap-2">
            <div class="flex-1 w-full p-2 bg-white shadow rounded-md">
                <table id="tableCategory" class="mt-10">
                    <thead>
                        <tr>
                            <th class="w-14 text-xs lg:text-md">#</th>
                            <th class="text-xs lg:text-md">Nama Kategori</th>
                            <th class="w-20 pl-4 text-xs lg:text-md">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="flex-0 w-full lg:max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Tambah Kategori</p>
                    <form action="{{ route('category.store') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        <label for="namaKategori">Nama Kategori <span class="text-red-500">*</span></label>
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
        <div x-show="show" x-transition:enter="animate__animated animate__fadeIn animate__faster"
            x-transition:leave="animate__animated animate__fadeOut animate__faster"
            class="fixed w-screen h-screen bg-black bg-opacity-10 backdrop-blur-sm top-0 left-0 flex items-center justify-center">
            <div x-show="show" x-transition:enter="animate__animated animate__fadeInUp animate__faster"
                x-transition:leave="animate__animated animate__fadeOutDown animate__faster"
                class="flex-0   px-3 py-2 w-full max-w-96">
                <div class="form  w-full  bg-white border border-1  px-3 py-2">
                    <p class="text-lg font-bold py-2 border-b border-1">Edit Kategori</p>
                    <form action="{{ route('category.update') }}" method="POST" class="flex mt-3 flex-col">
                        @csrf
                        @method('PATCH')
                        <label for="namaKategori">Nama Kategori</label>

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
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('initializeData', () => ({
                id: '',
                name: '',
                show: false,
                editCategory(id, name) {
                    this.show = true
                    this.id = id
                    this.name = name
                }

            }))
        });

        function format(d) {
            return (
                'Nama Kategori: ' + d.name
            );
        }

        $(document).ready(function() {
            const table = $('#tableCategory').DataTable({
                fixedHeader: true,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],

                ajax: '/categories-data',
                columns: [{
                        class: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: 'name',
                        title: 'Nama Kategori'
                    },
                    {
                        data: null,
                        title: 'Action',
                        render: function(data, type, row) {
                            return `
                            <div class="flex space-x-2">
                                <button x-on:click="editCategory('${row.id}', '${row.name}')"
                            class="text-green-500 px-2 py-1 rounded-md bg-green-100">Edit</button>
                        <form action="/category/delete/${row.id}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 px-2 py-1 rounded-md bg-red-100">Delete</button>
                        </form>
                            </div>

                    `;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                processing: true,
                serverSide: true
            });

            const detailRows = [];

            table.on('click', 'tbody td.dt-control', function() {
                let tr = event.target.closest('tr');
                let row = table.row(tr);
                let idx = detailRows.indexOf(tr.id);



                if (row.child.isShown()) {
                    tr.classList.remove('details');
                    row.child.hide();

                    detailRows.splice(idx, 1);
                } else {
                    tr.classList.add('details');
                    row.child(
                        "<div class='flex flex-col gap-2 items-start'>" +
                        format(row.data()) +
                        "</div>"
                    ).show();

                    if (idx === -1) {
                        detailRows.push(tr.id);
                    }
                }
            });

            // On each draw, loop over the `detailRows` array and show any child rows
            table.on('draw', () => {
                detailRows.forEach((id, i) => {
                    let el = document.querySelector('#' + id + ' td.dt-control');

                    if (el) {
                        el.dispatchEvent(new Event('click', {
                            bubbles: true
                        }));
                    }
                });
            });

        });
    </script>
@endsection
