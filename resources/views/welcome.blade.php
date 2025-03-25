<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vps-MicroServices</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logos/VigiaLogo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white min-h-screen flex flex-col items-center justify-center">
    <header class="w-full bg-blue-900 py-6 flex justify-center shadow-lg">
        <div class="max-w-4xl w-full flex justify-center">
            <img src="{{ asset('logos/VigiaLogo.png') }}" alt="Logo Vigia"
                class="w-48 h-auto p-4 bg-white rounded-lg shadow-md">
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center text-center p-6">

        <!-- Mensajes de alerta -->
        @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        @auth
        @if( ! auth()->user()->hasAnyRole(['Administrador', 'Autorizador']) )
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            Su usuario NO está asociado a un Rol con permisos para ingresar, por favor contacte al Administrador.
        </div>
        @endif
        @endauth

        <!-- Título y mensaje descriptivo -->
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Vps-MicroServices</h1>
        <p class="text-lg text-gray-600 mb-6">Accede a nuestros aplicativo web mediante tu usuario registrado con permisos, y usa nuestros Micro-Servicios con nuestra Interfaz Intuitiva.</p>

        <!-- Botones con animación -->
        @auth
        @if(auth()->user()->hasAnyRole(['Administrador', 'Autorizador']))
        <a href="{{ url('/dashboard') }}"
            class="bg-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition transform duration-300 hover:bg-blue-900 hover:scale-105">
            Volver al Menú Principal
        </a>
        @else
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-blue-900 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition transform duration-300 hover:bg-blue-800 hover:scale-105">
                Cerrar Sesión
            </button>
        </form>
        @endif
        @else
        <a href="{{ route('login') }}"
            class="bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition transform duration-300 hover:bg-orange-600 hover:scale-105">
            Ingresar a Vps-MicroServices
        </a>
        @endauth

    </main>

    @stack('modals')
    @livewireScripts
</body>

</html>