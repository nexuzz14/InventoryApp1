@extends('layouts.dashboard')
@section('content')
    <div class="w-full" x-data="{
        show: false,
        id: '',
        name: '',
        qty: '',
        nominal: '',
        qtyPay: '',
        calculate() {
            // Menghitung nilai total pembayaran dan selisih
            let total = parseFloat(this.qtyPay.replace(',', '.')) + parseFloat(this.nominal.replace(',', '.')) - parseFloat(this.qty.replace(',', '.'));
            return total;
        },
        formatRupiah(value) {
            const fixedValue = parseFloat(value).toFixed(2);
            const parts = fixedValue.split('.');
            const formatted = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return 'Rp ' + formatted + ',' + parts[1];
        }
    }">

        <div class="box flex-1 w-full">
            {{-- modal --}}

            <div x-show="show" x-transition:enter="animate__animated animate__faster animate__fadeIn"
                x-transition:leave="animate__animated animate__faster animate__fadeOut"
                class="fixed z-40 top-0 left-0 p-4 w-screen h-screen flex items-center backdrop-brightness-50 justify-center">
                <div x-show="show" x-transition:enter="animate__animated animate__faster animate__fadeInUp"
                    x-transition:leave="animate__animated animate__faster animate__fadeOutDown"
                    class="box md:max-w-md w-full p-2 bg-white rounded-md border">
                    <div class="flex justify-between py-2 border-b items-center">
                        <h4 class="text-lg font-bold  ">Konfirmasi Pembayaran ?</h4>

                        <lord-icon src="https://cdn.lordicon.com/jzvoyjzb.json" trigger="in" state="in-reveal"
                            class="h-10 w-10">
                        </lord-icon>
                    </div>

                    <div class="pricing w-full">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="px-3 py-2 w-1/2">Total</td>
                                    <td class="px-2 text-center py-2">:</td>
                                    <td class="px-3 py-2 text-end" x-text="formatRupiah(qty)"></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="px-3 py-2 w-1/2">Terbayar</td>
                                    <td class="px-2 text-center py-2">:</td>
                                    <td class="px-3 py-2 text-end" x-text="formatRupiah(qtyPay)"></td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-2 w-1/2">Nominal Bayar</td>
                                    <td class="px-2 text-center py-2">:</td>
                                    <td class="px-3 py-2 text-end relative">
                                        <p x-show="nominal!=0" x-text="formatRupiah(nominal)" class="text-end"></p>
                                        <input
                                            class="text-end absolute text-transparent pr-2 bg-transparent w-full top-0 left-0 h-full active:ring-0 active:outline-none focus:outline-none focus-within:ring-0"
                                            type="number" placeholder="Nominal" x-model='nominal'>
                                    </td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-3 py-2 w-1/2">
                                        <span
                                            x-text="() => {
                                            
                                            const total = calculate();
                                            return total > 0 ? 'Kembali' : (total < 0 ? 'Kurang' : 'Kembali / Kurang');
                                        }"></span>
                                    </td>
                                    <td class="px-2 text-center py-2">:</td>
                                    <td class="px-3 py-2 text-end relative">
                                        <span x-show="nominal != ''"
                                            x-text="formatRupiah(((parseFloat(qtyPay.replace(',', '.')) + parseFloat(nominal.replace(',', '.'))) - parseFloat(qty.replace(',', '.'))))"></span>
                                        <span x-show="nominal == ''">Rp.0,00</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btnGroup mt-20 text-white font-semibold flex gap-2">
                        <button @click="show=false" class="flex-1 bg-red-500">
                            Batal
                        </button>
                        <form method="POST" action="{{ route('invoice.updatePayment') }}" class="flex-1">
                            @csrf
                            <input type="hidden" name="id" x-model="id">
                            <input type="hidden" name="nominal" x-model="nominal">
                            <button class="bg-green-500 w-full">Oke</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- modal --}}


            <div class="card col-span-2 xl:col-span-1 px-4 md:max-w-full overflow-x-auto">
                <div class="card-header">List Tagihan</div>
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
                // console.log(d);
                let li = '';
                for (let i = 0; i < d.request_item.request_details.length; i++) {
                    li += `
                    <li class="w-full min-w-screen h-[50px] flex items-center justify-start bg-white border border-1 drop-shadow-md">
                        <div class="flex items-center justify-center">
                            <p class="ml-2 text-gray-500 text-sm font-semibold">${d.request_item.request_details[i].item.name}: </p>
                            <p class="ml-2 text-gray-500 text-sm font-semibold">${d.request_item.request_details[i].quantity} ${d.request_item.request_details[i].item.unit.name}</p>
                            <p class="ml-2 text-gray-500 text-sm font-semibold">${d.request_item.request_details[i].item.price}: Rp. ${d.request_item.request_details[i].item.price * d.request_item.request_details[i].quantity}</p>
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

                    ajax: '/list/invoice',
                    columns: [{
                            class: 'dt-control',
                            orderable: false,
                            data: null,
                            defaultContent: ''
                        },
                        {
                            data: 'request_item.nama_pemohon',
                            title: 'Nama / Instansi Pemohon'
                        },
                        {
                            data: 'staff.name',
                            title: 'Nama Staff'
                        },
                        {
                            data: 'total_qty',
                            title: 'Total Jumlah Barang'
                        },
                        {
                            data: 'total_appoved_items',
                            title: 'Total Jenis Barang'
                        },
                        {
                            data: 'total_price',
                            title: 'Total Harga'
                        },
                        {
                            data: 'dibayarkan',
                            title: 'Total Bayar'
                        },
                        {
                            data: 'status',
                            title: 'Status'
                        },
                        {
                            data: null,
                            title: 'Action',
                            render: function(data, type, row) {
                                return `
                            <div class="flex space-x-2">
                                     ${
                row.status !== 'paid'
                ? `<button @click="id=${row.id},name='${row.request_item.nama_pemohon}', qty='${row.total_price}', qtyPay='${row.dibayarkan}', show=true"
                                class="text-green-500 px-2 py-1 rounded-md bg-green-100">Bayar</button>`
                : ''  // Jika status 'paid', tidak menampilkan tombol Bayar
            }
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
                        console.log(row.data());
                        row.child(
                            `<div class='flex flex-col gap-2 items-start w-full min-w-screen'>
                            ${format(row.data())}
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
    </div>
@endsection
