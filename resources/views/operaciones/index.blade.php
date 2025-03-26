@extends('layouts.administradorlayout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Gestión de Operaciones</h2>
        <a href="{{ route('operaciones.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Nueva Operación
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bodega</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($operaciones as $operacion)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $operacion->nombre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $operacion->bodega }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('operaciones.edit', $operacion->id) }}" class="text-blue-500 hover:text-blue-600 mr-3">Editar</a>
                        <form action="{{ route('operaciones.destroy', $operacion->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('¿Estás seguro?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
