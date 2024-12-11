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

<body class="font-sans antialiased" x-data="{ openNav: false, loadingText:'Memuat...', loading:true }" x-init="openNav = false">
    @include('layouts.navigation')

    <x-notivication-handler :message="session('message')"></x-notivication-handler>
    {{-- <div x-show="loading" class="loadingScreen fixed top-0 left-0 flex items-center justify-center z-50 h-screen bg-white w-screen">
        <div class="flex flex-col gap-3">
            <script src="https://cdn.lordicon.com/lordicon.js"></script>
            <lord-icon src="https://cdn.lordicon.com/wsdieofl.json" trigger="loop" style="width:250px;height:250px">
            </lord-icon>
            <div class="text-center text-lg" x-model="loadingText"></div>

        </div>
    </div> --}}

    <div class="h-screen bg-gray-100 flex flex-row absolute w-full " style="">

        @include('components.sidebar')
     
        <div class=" flex-1 p-6 md:mt-16 overflow-y-auto">
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
                sidebar.classList.toggle('-ml-64');
                sidebar.classList.toggle('ml-0');
                sidebar.classList.toggle('animate__slideInLeft');
        }
    </script>
    {{-- <script></script> --}}
    <x-script-pack></x-script-pack>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>

    
</body>

</html>
