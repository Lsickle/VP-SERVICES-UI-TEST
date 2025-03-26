@extends('layouts.administradorlayout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Gestión de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Nuevo Usuario
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-4">
        <form action="{{ route('usuarios.index') }}" method="GET" class="flex">
            <input type="text" name="search" placeholder="Buscar usuarios..." value="{{ request('search') }}"
                class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
                Buscar
            </button>
        </form>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo Electrónico</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($usuarios as $usuario)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $usuario->getRoleNames()->first() ?? 'Sin asignar' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $usuario->operacion ? $usuario->operacion->nombre : 'Sin asignar' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-blue-500 hover:text-blue-600 mr-3">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
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

    <!-- Paginación -->
    <div class="mt-4">
        {{ $usuarios->appends(request()->input())->links() }}
    </div>
</div>
@endsection
