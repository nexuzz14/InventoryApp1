@props(['disabled' => false, "wiremodel" => "", "title" => "", "id" => "id", "name" => "name", "type" => "text", "autocomplete" => '', "value" => '', 'maxlength' => "", "max" => 0, "min" => 0])

<div class="mt-3">
    @if ($title != '')
        <x-input-label>{{ $title }}</x-input-label>
    @endif
    <input required min="{{ $min != 0 ? $min : 0 }}" {{ $wiremodel != "" ? "wire:model=" . $wiremodel : "" }} max="{{ $max != 0 ? $max : "" }}" {{ $disabled ? "disabled" : '' }} {{$value != '' ? "value=" . $value : ''}} {!! $attributes->merge(['class' => 'h-10 mt-2 bg-white border rounded-md focus:ring-0 focus:outline-none active:ring-0 p-2 w-full', 'name' => $name, "type" => $type, "id" => $id, "autocomplete" => $autocomplete]) !!}>
</div>
