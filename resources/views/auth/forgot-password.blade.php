<x-guest-layout>
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-2xl border border-gray-300">
        
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('logos/VigiaLogo.png') }}" alt="Logo Simulador VPS" class="w-48">
        </div>

        <!-- Texto informativo -->
        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
        </div>

        <!-- Estado de la sesión -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validación de errores -->
        <x-validation-errors class="mb-4" />

        <!-- Formulario de reseteo -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                    {{ __('Enviar enlace para restablecer la contraseña') }}
                </x-button>
            </div>
        </form>
    </div>
</x-guest-layout>
