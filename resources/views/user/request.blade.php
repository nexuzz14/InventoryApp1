@extends('layouts.app')
@section('content')
    <div class="box max-w-6xl p-6 flex flex-wrap">
        <div class="img md:w-full lg:w-[500px] bg-gray-500 rounded-lg overflow-hidden lg:h-[500px] md:h-96 ">
            <img src="{{Storage::url($selectedUnit->image)}}" class="h-full w-full  object-contain" alt="gambar produk">
        </div>
    </div>
@endsection