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

<body class="font-sans antialiased" x-data="{ openNav: false }">
    @include('layouts.navigation')
    <x-notivication-handler :message="session('message')"></x-notivication-handler>

    <div class="h-screen flex flex-row absolute w-full " style="">

        @include('components.sidebar')
        <div id="overlay" x-show="openNav" @click="openNav = false" x-init="openNav = false"
            class="fixed inset-0 z-40 bg-black/40"></div>
        <div class="bg-gray-100 flex-1 p-6 md:mt-16 overflow-y-auto">
            @yield('content')
        </div>

    </div>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                fixedHeader: true,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            if (window.innerWidth < 1024) {
                overlay.classList.toggle('hidden');
                sidebar.classList.toggle('md:-ml-64');
                sidebar.classList.toggle('lg:ml-0');
                sidebar.classList.toggle('md:slideOutLeft');
                sidebar.classList.toggle('md:slideInLeft');
            }
        }
    </script>
    {{-- <script></script> --}}
    <x-script-pack></x-script-pack>
</body>

</html>
