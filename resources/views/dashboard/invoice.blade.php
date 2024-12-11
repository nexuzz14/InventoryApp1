@extends('layouts.dashboard')
@section('content')
    <div class="box flex-1 w-full">
        <div class="card col-span-2 xl:col-span-1 px-4 md:max-w-full overflow-x-auto">
            <div class="card-header">Kategori</div>
            <table id="tablePermintaan" class="">
                <thead>
                    <tr>
                        <th class="w-14">#</th>
                        <th class="whitespace-nowrap">Nama / Instansi Pemohon</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    <td></td>
                </tbody>
            </table>
        </div>
        <div id="loadingModal" style="display: none;"
            class="fixed top-0 left-0 z-40 flex items-center justify-center w-screen h-screen bg-gray-900 bg-opacity-50">
            <div role="status" class="">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        function format(d) {
            console.log(d);
            let li = '';
            for (let i = 0; i < d.request_details.length; i++) {
                li += `
                    <li class="w-full min-w-screen h-[50px] flex items-center justify-start bg-white border border-1 drop-shadow-md">
                        <div class="w-[50px] h-[50px] flex items-center justify-center">
                            <input type="checkbox" data-quantity="${d.request_details[i].quantity}" data-detail-id="${d.request_details[i].id}" ${d.request_details[i].status == 'accepted' ? 'checked' : ''} class="checkbox-item peer w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required="">
                        </div>
                        <div>
                            <p class="ml-2 text-gray-500 text-sm font-semibold">${d.request_details[i].item.name}</p>
                            <p class="ml-2 text-gray-500 text-sm font-semibold">Jumlah: ${d.request_details[i].quantity} ${d.request_details[i].item.unit.name}</p>
                        </div>
                    </li>
                `
            }
            let ul = `
                <ul class="w-full min-w-screen space-y-2">
                    ${li}    
                </ul>
            `
            return ul
        }

        function prosesPermintaan(requestId) {
            console.log(requestId);
            let isRequestInProgress = true;
            $('#loadingModal').show();
            window.addEventListener("beforeunload", function(e) {
                if (isRequestInProgress) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
            $.ajax({
                url: "{{ route('transaction.store') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    request_id: requestId
                },
                success: function(response) {
                    $('#loadingModal').hide();
                    isRequestInProgress = false;
                    window.location.reload();
                },
                error: function(xhr) {
                    $('#loadingModal').hide();
                    isRequestInProgress = false;
                }
            });
        }

        $(document).ready(function() {

            $(document).on('change', '.checkbox-item', function() {
                let detailId = $(this).data('detail-id');
                let quantity = $(this).data('quantity');
                let isChecked = $(this).is(':checked');
                let isRequestInProgress = true;

                $('#loadingModal').show();
                window.addEventListener("beforeunload", function(e) {
                    if (isRequestInProgress) {
                        e.preventDefault();
                        e.returnValue = '';
                    }
                });


                $.ajax({
                    url: "{{ route('request.item.detail') }}",
                    type: "PATCH",
                    data: {
                        id: detailId,
                        quantity: quantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#loadingModal').hide();
                        isRequestInProgress = false;
                    },
                    error: function(xhr) {
                        console.error('Error: Terjadi Kesalahan saat memproses permintaan');
                    }
                });
            });


            const table = $('#tablePermintaan').DataTable({
                fixedHeader: true,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],

                ajax: '/request-barang',
                columns: [{
                        class: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: 'nama_pemohon',
                        title: 'Nama / Instansi Pemohon'
                    },
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
                        `<div class='flex flex-col gap-2 items-start w-full min-w-screen'>
                        ${format(row.data())}
                        <button onclick = 'prosesPermintaan(${row.data().id })' type = 'submit' class = 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' >
                            Proses 
                            </button>  
                        </div > `
                    ).show();

                    if (idx === -1) {
                        detailRows.push(tr.id);
                    }
                }
            });

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
