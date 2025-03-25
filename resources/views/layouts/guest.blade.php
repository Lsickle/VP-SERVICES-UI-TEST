<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vps-MicroServices</title>

    <!-- Favicon -->
    <link rel="icon" type="logos/VigiaLogo.png" href="{{ asset('logos/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-950 to-blue-800 flex items-center justify-center min-h-screen">
    
    <!-- Contenedor con más sombras -->
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-2xl border-t-4 border-orange-600 mt-6">
        <div class="text-gray-900">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>