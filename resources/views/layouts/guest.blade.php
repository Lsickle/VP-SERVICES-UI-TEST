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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/global.js' ]) <!-- Se agrega el global con los scripts -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white min-h-screen flex flex-col">
    <!-- Header -->
    @include('components.header')

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Área de contenido: se expande y centra su contenido verticalmente -->
    <main class="flex-grow flex items-center justify-center px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    @stack('modals')
    @livewireScripts
</body>

</html>