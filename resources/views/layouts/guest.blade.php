<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Plataforma de microservicios de Vigia Plus Services. Accede a herramientas empresariales para gestión de ingresos, tracking y más.">
    <title>Vps-MicroServices</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logos/VigiaLogo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased bg-white min-h-screen flex flex-col">
    <!-- Header -->
    @include('components.header')

    <!-- Contenedor principal: se apila en móviles y en desktop se coloca en fila -->
    <div class="flex flex-col md:flex-row flex-1">
        <!-- Área de contenido -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('components.footer')

    @stack('modals')
    @livewireScripts
</body>

</html>