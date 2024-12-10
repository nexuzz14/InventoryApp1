@extends('layouts.app')
@section('content')
    <div class="box max-w-7xl p-6 w-full flex flex-wrap gap-3">
        <div class="img md:w-full lg:w-[500px] bg-gray-500 rounded-lg overflow-hidden lg:h-[500px] md:h-96 ">
            <img src="{{ Storage::url($selectedUnit->image) }}" class="h-full w-full  object-contain" alt="gambar produk">
        </div>
        <div class="w-full flex flex-col gap-2 lg:flex-1">
            <div class="top flex-1 p-2 flex justify-between flex-col text-gray-800 bg-white border">


                <div class="w-full">
                    <h2 class="lg:text-5xl cursor-default md:text-3xl mt-2 font-bold line-clamp-2">{{ $selectedUnit->name }}</h2>
                <div class="flex gap-2 flex-wrap mt-4 cursor-default">
                    <div
                        class="border-orange-500  hover:shadow-lg py-1 shadow-md duration-150 bg-orange-100 border text-orange-600 w-fit px-3 rounded-md text-sm">
                        {{ $selectedUnit->category->name }}</div>

                    <div
                        class="{{ $selectedUnit->quantity > 0 ? 'border-green-500 bg-green-100 text-green-600' : 'border-red-500 bg-red-100 text-red-600' }} w-fit px-3 py-1 capitalize rounded-md text-sm whitespace-nowrap  duration-150 shadow-md border hover:shadow-lg">
                        Stock : {{ $selectedUnit->quantity }} {{ $selectedUnit->unit->name }}</div>

                    <div
                        class="{{ $selectedUnit->status === 'tersedia' ? 'border-green-500 bg-green-100 text-green-600' : 'border-red-500 bg-red-100 text-red-600' }} w-fit px-3 py-1 capitalize rounded-md text-sm whitespace-nowrap shadow-md border hover:shadow-lg duration-150">
                        Ketersediaan : {{ $selectedUnit->status }}</div>
                </div>
                <div class="harga md:text-lg mt-2 text-xl text-gray-600">
                    Rp.{{ number_format($selectedUnit->price, 0, ',', '.') }}
                </div>
                </div>
                <div x-data="{ value: {{ $selectedUnit->quantity > 0 ? '1' : '0'}} }" class="w-full">
                    <div class="w-full max-w-sm  bg-white">
                        <label for="slider" class="block text-md font-medium text-gray-700 mt-4">Quantity</label>
                        <div class="flex items-center gap-4 mt-2">
                            <button @click="value = Math.max(0, value - 1)"
                                class="px-3 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">
                                -
                            </button>
                            <input x-model="value" id="slider" type="range" min="0" max="13"
                                class="w-full h-2 bg-gray-200 focus:ring-0 focus:outline-none rounded-lg appearance-none">
                            <button @click="value = Math.min(13, value + 1)"
                                class="px-3 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">
                                +
                            </button>
                            <input class="shadow-md hover:shadow-lg w-10 text-center" min="0" max="{{$selectedUnit->quantity}}"
                                type="number" name="quantity" x-model="value" @input="value = Math.max(0, Math.min({{ $selectedUnit->quantity }}, value))"
                                id="">
    
                        </div>
                        
                    </div>
                    <form action="" method="POST">
                        @method("POST")
                        @csrf
                        <input name="item_id" type="hidden" value="{{Crypt::encrypt($selectedUnit->id)}}">
                        <input name="quantity" type="hidden" value="" x-model="value">
                        <button type="submit" class="w-full py-2 bg-blue-400 text-white rounded-md mt-3 mb-2 hover:shadow-lg duration-150 ">Tambah Ke Daftar Order</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
