@extends('layouts.app')

@section('header')
<h2 class="center text-xl font-semibold text-white">Panel de Control Administrativo</h2>
@endsection


@section('content')
<div class="space-y-8">
    <!-- Bienvenida -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h1 class="text-3xl font-bold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Permisos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \Spatie\Permission\Models\Permission::count() }}
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <span class="text-blue-600 text-xl">🔑</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Roles</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \Spatie\Permission\Models\Role::count() }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <span class="text-purple-600 text-xl">🛡️</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Usuarios Activos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <span class="text-orange-600 text-xl">👥</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos Usuarios Registrados -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Últimos Usuarios Registrados</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Registro</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $user->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $user->email }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{
                            $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reportes Rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Reportes de Actividad</h3>
            <p class="text-gray-600 text-sm">
                Aquí puedes incluir gráficos o indicadores de la actividad del sistema, como el número de acciones
                realizadas,
                registros recientes, etc.
            </p>
            <a href="#"
                class="mt-4 inline-block bg-blue-800 text-white py-2 px-4 rounded hover:bg-blue-900 transition-colors">
                Ver Reportes Detallados
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones Recientes</h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <li>Usuario X creó un nuevo permiso.</li>
                <li>Usuario Y actualizó un rol.</li>
                <li>Se importaron 15 registros de trabajadores.</li>
                <!-- Más acciones -->
            </ul>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Gestión de Permisos -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gestión de Permisos</h3>
            <div class="space-y-3">
                <a href="{{ route('seguridad.permisos.create') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">➕</span>
                    <span class="text-gray-700 font-medium">Crear Nuevo Permiso</span>
                </a>
                <a href="{{ route('seguridad.permisos.index') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">📋</span>
                    <span class="text-gray-700 font-medium">Listar Permisos</span>
                </a>
            </div>
        </div>

        <!-- Gestión de Roles -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gestión de Roles</h3>
            <div class="space-y-3">
                <a href="{{ route('seguridad.roles.create') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">➕</span>
                    <span class="text-gray-700 font-medium">Crear Nuevo Rol</span>
                </a>
                <a href="{{ route('seguridad.roles.index') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">📋</span>
                    <span class="text-gray-700 font-medium">Listar Roles</span>
                </a>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gestión de Usuarios</h3>
            <div class="space-y-3">
                <a href="{{ route('usuarios.create') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">➕</span>
                    <span class="text-gray-700 font-medium">Crear Nuevo Usuario</span>
                </a>
                <a href="{{ route('usuarios.index') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">📋</span>
                    <span class="text-gray-700 font-medium">Listar Usuarios</span>
                </a>
            </div>
        </div>

        <!-- Gestión de Operaciones -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gestión de Operaciones</h3>
            <div class="space-y-3">
                <a href="{{ route('operaciones.create') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">➕</span>
                    <span class="text-gray-700 font-medium">Crear Nueva Operación</span>
                </a>
                <a href="{{ route('operaciones.index') }}"
                    class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                    <span class="text-orange-600 mr-3">📋</span>
                    <span class="text-gray-700 font-medium">Listar Operaciones</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection