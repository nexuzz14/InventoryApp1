@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-pink-600'
            : 'text-gray-800 hover:text-slate-600 duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
