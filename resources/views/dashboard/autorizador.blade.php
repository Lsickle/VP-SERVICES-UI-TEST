<x-app-layout>
    <div id="mainContent" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Panel de Control Autorizador</h2>
    
        <!-- Bienvenida -->
        <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
        </div>
    
        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Solicitudes</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ count($solicitudes) }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <span class="text-blue-600 text-xl">🔑</span>
                    </div>
                </div>
            </div>
    
            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Solicitudes Nuevas</p>
                        <!-- Aquí podrías filtrar las solicitudes nuevas, por ejemplo -->
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ count($solicitudes) }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <span class="text-purple-600 text-xl">🛡️</span>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Últimas Solicitudes de Agendamiento -->
        <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Últimas Solicitudes de Agendamiento</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">OP</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Proveedor</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Bodega</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Fecha De Entrega</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $solicitud['op'] ?? '-' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $solicitud['proveedor'] ?? '-' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $solicitud['bodega'] ?? '-' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($solicitud['fecha_entrega'] ?? null)->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                        @if(empty($solicitudes))
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-600">
                                No se encontraron solicitudes.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Acciones Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gestión de Solicitudes -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Gestión de Solicitudes</h3>
                <div class="space-y-3">
                    <a href="{{ route('seguridad.permisos.index') }}"
                        class="flex items-center p-3 bg-gray-50 hover:bg-orange-50 rounded-lg transition-colors">
                        <span class="text-orange-600 mr-3">📋</span>
                        <span class="text-gray-700 font-medium">Listar Solicitudes</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
