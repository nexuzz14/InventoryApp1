@extends('layouts.app')
@section('content')
    <div class="flex gap-4 p-3 pt-14  mt-10 max-w-7xl w-full flex-wrap">
        <div class="flex-1 w-full h-fit bg-white border border-1">
            <div class="title px-3 py-2 font-bold">Keranjang Anda</div>
            <table class="w-full table-auto">
                <th>
                    <tr class="bg-gray-200">
                        <td class="w-14 px-3 py-2">#</td>
                        <td class="px-3 py-2">Nama Barang</td>
                        <td class="px-3 py-2">Price</td>
                        <td class="w-20 px-3 py-2 text-center">Quantity</td>
                    </tr>
                </th>
                @php
                    $totalPrice = 0;
                    $totalQty = 0;
                    $index = 0;
                @endphp
                <tbody class="min-h-40">
                    @isset($data)
                        @foreach ($data as $item)
                            <tr class="border-b">
                                <td class="w-14 px-3 py-2">
                                    <form method="POST"
                                        action="{{ route('chart.delete', ['id' => Crypt::encrypt($item->id)]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-400">
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                                <td class="px-3 py-2">{{ $item->item->name }}</td>
                                <td class="px-3 py-2">Rp{{ number_format($item->item->price * $item->quantity, 0, ',', '.') }}
                                    / <small class="text-xs">Rp.{{ number_format($item->item->price, 0, ',', '.') }}</small>
                                </td>
                                <td class="w-20 px-3 py-2">
                                    <form x-data="{ value: {{ $item->quantity ?? 0 }} }" method="POST"
                                        action="{{ route('chart.update', ['id' => Crypt::encrypt($item->id)]) }}"
                                        class="flex gap-2 whitespace-nowrap">
                                        @method('PATCH')
                                        @csrf
                                        <input class="w-8 p-1 border py-0" type="number" x-model="value" name="quantity"
                                            @input="value = Math.max(0, Math.min({{ $item->item->quantity ?? 0 }}, value))"
                                            @change="$el.closest('form').submit()">
                                        <div class="">
                                            (qty)
                                        </div>
                                    </form>

                                </td>
                            </tr>
                            @php
                                $totalQty += $item->quantity;
                                $totalPrice += $item->item->price;
                            @endphp
                        @endforeach
                    @endisset


                </tbody>
                <tfoot>
                    <tr>
                    <tr>
                        <td class="w-14 px-3 py-2"></td>
                        <td class="px-3 py-2">Total</td>
                        <td class=" px-3 py-2">
                            Rp.{{ number_format($totalPrice, 0, ',', '.') }}
                        </td>
                        <td class="px-3 w-20 py-2">
                            {{ $totalQty }} (qty)

                        </td>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex-0 w-full max-w-96 border border-1 bg-white p-4">
            <div class="flex border-b pb-3 items-center gap-2">
                <svg class="w-6 h-6 text-gray-700 mb-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z"
                        clip-rule="evenodd" />
                </svg>
                <p class="font-bold">Order</p>
            </div>
            <div x-data="{ peminta: '{{ Auth::check() ? Auth::user()->name : '' }}' }" class="flex flex-col mt-3 h-full flex-1">

                <label for="">Nama Peminta<span class="text-red-500">*</span></label>
                <input type="text" x-model="peminta" class="bg-gray-200 mt-1 p-2 rounded mb-2"/>
                <label for="">Total (otomatis)</label>
                <div class="box flex gap-2 w-full">
                    <div class="bg-gray-200 flex-1 w-full mt-1 p-2 rounded">{{ $data->count() }} Item /
                        {{ $totalQty }} (Qty)</div>
                    <div class="bg-gray-200 flex-1 w-full mt-1 p-2 rounded">
                        Rp.{{ number_format($totalPrice, 0, ',', '.') }}</div>
                </div>
                @php
                    $i = 0;
                @endphp
                <form method="POST" action="{{ route('chart.store') }}">
                    @csrf
                    <input type="hidden" value="{{ Crypt::encrypt(Auth::user()->id) }}" name="staff_id">
                    <input type="hidden" x-model="peminta" name="peminta">
                    @foreach ($data as $item)
                        <input type="hidden" value="{{ $item->id }}" name="chartData[]">

                        <input type="hidden" value="{{ $item->item_id }}" name="items[{{ $i }}][item_id]">
                        <input type="hidden" value="{{ $item->quantity }}" name="items[{{ $i }}][quantity]">
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    <button :disabled="peminta.trim() === ''"
                        :class="peminta.trim() === '' ? 'bg-gray-400 cursor-not-allowed' :
                            'bg-blue-400 hover:bg-blue-500'"
                        class="w-full font-bold text-white text-center py-3 mt-4">
                        Order Sekarang
                    </button>

                </form>

            </div>
        </div>
    </div>
@endsection
