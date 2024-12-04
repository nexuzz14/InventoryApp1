@props(['title'=>'title', "name"=>"name", "id" => "id"])
<div class="mt-2">
    <x-input-label for="{{$id}}" class="block text-sm font-medium text-gray-700">{{$title}} :</x-input-label>
    <select id="{{$id}}" name="{{$name}}" required class="mt-1 block w-full p-2 border active:ring-0 focus:ring-0 active:outline-none focus:outline-none border-gray-300 ">
       {{$slot}}
    </select>
</div>