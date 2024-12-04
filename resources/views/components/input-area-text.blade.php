@props(['disabled' => false, "title"=>"", "id"=>"id", "name"=>"name", "type"=>"text", "autocomplete"=>'', "value"=>''])

<div class="mt-3">

  @if ($title != '')
  <x-input-label>{{$title}} :</x-input-label>
  @endif

  <textarea  required {{ $disabled ? "disabled" : '' }} {!! $attributes->merge(['class' => 'h-10  mt-2 bg-white resize-none  border focus:ring-0 focus:outline-none active:ring-0 active:ring-0 p-2 w-full ', 'name'=>$name, "type"=>$type, "id"=>$id, "autocomplete"=>$autocomplete]) !!} cols="30" rows="10">{{$value != '' ? "value=" .$value: ''}}</textarea>
</div>
