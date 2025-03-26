@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md bg-white p-8 rounded-lg shadow-2xl border border-gray-300 mx-auto">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('logos/VigiaLogo.png') }}" alt="Logo Simulador VPS" class="w-48">
    </div>

    <!-- Validación de errores -->
    <x-validation-errors class="mb-4" />

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <!-- Formulario de inicio de sesión -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-label for="email" value="{{ __('Correo Electrónico') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" placeholder="Ingresa tu Correo Registrado"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-label for="password" value="{{ __('Contraseña') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" placeholder="Ingresa tu Contraseña"
                name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-checkbox id="remember_me" name="remember" />
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
            <a class="text-sm text-blue-700 hover:text-blue-900" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            @endif

            <x-button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                {{ __('Iniciar Sesión') }}
            </x-button>
        </div>
    </form>
</div>
@endsection