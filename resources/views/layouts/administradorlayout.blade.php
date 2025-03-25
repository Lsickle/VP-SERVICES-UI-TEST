<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administrador - Vps-MicroServices</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logos/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased bg-gray-50">
    <x-banner />

    <!-- Contenedor principal sin sidebar -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-orange-500 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Título del panel -->
                <div class="flex-1 text-center">
                    <h1 class="text-gray-800 font-semibold text-lg sm:text-xl">
                        @yield('header') {{-- Título definido en la vista que extiende este layout --}}
                    </h1>
                </div>

                <!-- Navigation Menu Encapsulado -->
                @include('partials.navigation-menu')
            </div>
        </header>

        <!-- Contenido -->
        <main class="p-6 flex-1">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('modals')
    @livewireScripts
</body>

</html>
