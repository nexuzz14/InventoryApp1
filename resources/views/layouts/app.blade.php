<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <x-cdn></x-cdn>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

</head>

<body class="font-sans antialiased" x-data="{ openNav: false }" x-init="openNav = false">
    @include('layouts.navigation')
    <x-notivication-handler :message="session('message')"></x-notivication-handler>

    <div class="w-full pt-16 max-w-7xl flex items-center justify-center flex-col" style="">

            @yield('content')

    </div>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    
    {{-- <script></script> --}}
    <x-script-pack></x-script-pack>
</body>

</html>
