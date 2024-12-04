@extends('layouts.app')
@section('content')
   <div class="flex gap-2">
    <div class="w-full flex-1 min-h-4 bg-white border border-1">
        <div class="title px-3 py-2 font-bold">Keranjang Anda</div>
        <table class="w-full ">
            <th>
                <tr class="bg-gray-300">
                    <td colspan="2" class="w-14 px-3 py-2">#</td>
                    <td class="px-3 py-2">Nama Barang</td>
                    <td class="w-20 px-3 py-2 text-center">Jumlah</td>
                </tr>
            </th>
            <tbody>
                <tr class="border-b">
                    <td class="w-14 px-3 py-2">
                        <button class="text-red-400">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                              </svg>
                              
                        </button>
                    </td>
                    <td class="w-8">
                        <form action="">
                            <input checked class="w-6 h-6" type="checkbox" name="" id="">
                        </form>
                    </td>
                    <td class="px-3 py-2">Rexona Jumbo 40 Liter</td>
                    <td class="w-20 px-3 py-2">
                        <form action="" class="flex gap-2 whitespace-nowrap">
                            <input class="w-8 p-1 border py-0" type="number" name="nomninalUpdate" id="" value="3">(qty)
                        </form>
                    </td>
                </tr>
                <tr  class="border-b">
                    <td class="w-14 px-3 py-2">
                        <button class="text-red-400">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                              </svg>
                              
                        </button>
                    </td>
                    <td class="w-8">
                        <form action="">
                            <input class="w-6 h-6" type="checkbox" name="" id="">
                        </form>
                    </td>
                    <td class="px-3 py-2">Rexona Jumbo 40 Liter</td>
                    <td class="w-20 px-3 py-2">
                        <form action="" class="flex gap-2 whitespace-nowrap">
                            <input class="w-8 p-1 border py-0" type="number" name="nomninalUpdate" id="" value="2">(qty)
                        </form>
                    </td>
                </tr>

                <tr  class="border-b">
                    <td class="w-14 px-3 py-2">
                        <button class="text-red-400">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                              </svg>
                              
                        </button>
                    </td>
                    <td class="w-8">
                        <form action="">
                            <input checked class="w-6 h-6" type="checkbox" name="" id="">
                        </form>
                    </td>
                    <td class="px-3 py-2">Rexona Jumbo 40 Liter</td>
                    <td class="w-20 px-3 py-2">
                        <form action="" class="flex gap-2 whitespace-nowrap">
                            <input class="w-8 p-1 border py-0" type="number" name="nomninalUpdate" id="" value="2">(qty)
                        </form>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <tr>
                        <td class="w-14 px-3 py-2">
                            
                        </td>
                        <td></td>
                        <td class="px-3 py-2">Total</td>
                        <td class="w-20 px-3 py-2">
                            5 (qty)
                        </td>
                    </tr>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="flex-0 w-full max-w-96 border border-1 bg-white p-4">
        <div class="flex border-b pb-2">
            <svg class="w-6 h-6 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z" clip-rule="evenodd"/>
              </svg>
             <p class="font-bold">Invoice</p>
        </div>
        <form action="" class="flex flex-col mt-3 h-full flex-1 ">
            <label for="">Nama Lengkap</label>
            <input type="text" value="Riss Kumala" disabled class="bg-gray-200 mt-1 p-2 rounded">
            <label for="">Total</label>
            <input type="text" value="2 (5 Qty)" disabled class="bg-gray-200 mt-1 p-2 rounded">
            <button class="w-full font-bold text-white text-center py-3 bg-blue-400 mt-4">Order Sekarang</button>
        </form>
    </div>
   </div>
@endsection