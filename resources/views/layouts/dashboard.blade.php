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

<body class="font-sans antialiased">
    @include('layouts.navigation')

    <div class="h-screen flex flex-row flex-wrap">

        @include('components.sidebar')
        <div class="bg-gray-100 flex-1 p-6 md:mt-16">
            @yield('content')
        </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            if (window.innerWidth < 768) {
                overlay.classList.toggle('hidden');
                sidebar.classList.toggle('md:-ml-64');
                sidebar.classList.toggle('lg:ml-0');
                sidebar.classList.toggle('md:slideOutLeft');
                sidebar.classList.toggle('md:slideInLeft');
            }
        }
    </script>
    <x-script-pack></x-script-pack>
</body>

</html>
