@props(["car"=>""])
<div wire:key="car-{{ $car->id }}" class="bg-gradient-to-r from-violet-200 to-pink-200 w-full h-[370px] border max-w-64 shadow-md rounded-lg overflow-hidden">
    <div class="box w-full h-48">
        <img src="{{Storage::url($car['foto'])}}" alt="Mobil 2" class="w-full h-48 object-contain">
    </div>
    <div class="p-4 flex-col ">
        <div class="w-full flex gap-1 text-lg mb-2 justify-between items-start uppercase">
            <h3 class="font-bold line-clamp-1 flex-1">{{$car['type']}}</h3>
            <div class="tahun">{{$car['tahun']}}</div>
            </div>
            <h3 class="font-bold -mt-3 line-clamp-1 flex-1">{{$car['brand']}}</h3>

        <p class="text-gray-600 font-semibold mt-2">Rp.{{number_format($car['harga'], 2 ,",", ".")}}/Hari</p>
        <div class="h-8 mt-6">
            @if (Auth::guard('administrator')->check() && Auth::guard('administrator')->user()->level == "petugas")
             <button wire:click='setEditDataCar({{$car->id}})' href="" class="bg-gradient-to-r py-2   border from-indigo-400 to-cyan-400 text-white px-4 rounded-md hover:bg-blue-700">edit</button>
             <button wire:click='setIdDelete({{$car->id}})' href="" class="bg-gradient-to-r py-2   border from-indigo-400 to-cyan-400 text-white px-4 rounded-md hover:bg-blue-700">Delete</button>
            @endif
            @if (!Auth::guard('administrator')->check())
            <a href="/mobil/sewa/{{$car->id}}" class="bg-gradient-to-r py-2  border from-indigo-400 to-cyan-400 text-white px-4 rounded-md hover:bg-blue-700">Sewa Sekarang</a>
            @endif
           
        </div>
    </div>
</div>