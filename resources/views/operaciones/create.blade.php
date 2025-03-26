@extends('layouts.administradorlayout')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Crear Nueva Operación</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('operaciones.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">
                    Nombre de la Operación:
                </label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('nombre')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bodega" class="block text-gray-700 text-sm font-bold mb-2">
                    Bodega:
                </label>
                <input type="text" name="bodega" id="bodega" placeholder="Ingrese la bodega"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('bodega')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection