<x-app-layout>
    <div class="container mx-auto py-10" x-data="{ search: '' }">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Gestión de Solicitudes de Agendamiento</h2>
        
        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <input type="text" x-model="search" placeholder="Buscar solicitudes por OP o correo..." class="w-full p-2 border rounded text-sm" />
        </div>
        
        <!-- Contenedor para slider horizontal en móvil -->
        <div class="overflow-x-auto">
            <!-- Tabla de solicitudes -->
            <table class="min-w-full divide-y divide-gray-300 text-xs md:text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-2 py-2 border-b border-gray-300">Fecha Entrega</th>
                        <th class="px-2 py-2 border-b border-gray-300">Bodega</th>
                        <th class="px-2 py-2 border-b border-gray-300">OP</th>
                        <th class="px-2 py-2 border-b border-gray-300">Código Artículo</th>
                        <th class="px-2 py-2 border-b border-gray-300">Nombre Artículo</th>
                        <th class="px-2 py-2 border-b border-gray-300">Cantidades Pedidas</th>
                        <th class="px-2 py-2 border-b border-gray-300">Placa Vehículo</th>
                        <th class="px-2 py-2 border-b border-gray-300">Conductor</th>
                        <th class="px-2 py-2 border-b border-gray-300">Cédula</th>
                        <th class="px-2 py-2 border-b border-gray-300">Correo Solicitante</th>
                        <th class="px-2 py-2 border-b border-gray-300">Estatus</th>
                        <th class="px-2 py-2 border-b border-gray-300">Fecha Creación</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($solicitudes as $solicitud)
                        <template x-if="'{{ Str::lower($solicitud['op'] ?? '') }}'.includes(search.toLowerCase()) || 
                                        '{{ Str::lower($solicitud['correo_solicitante'] ?? '') }}'.includes(search.toLowerCase())">
                            <tr>
                                <td class="px-2 py-2 text-center">{{ \Carbon\Carbon::parse($solicitud['fecha_entrega'])->format('d/m/Y') }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['bodega'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['op'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['codigo_articulo'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['nombre_articulo'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['cantidades_pedidas'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['placa'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['conductor'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['cedula'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $solicitud['correo_solicitante'] ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ ucfirst($solicitud['estatus']) }}</td>
                                <td class="px-2 py-2 text-center">{{ \Carbon\Carbon::parse($solicitud['created_at'])->format('d/m/Y') }}</td>
                            </tr>
                        </template>
                    @endforeach
                    <!-- Mensaje cuando no hay solicitudes -->
                    @if(empty($solicitudes))
                        <tr>
                            <td colspan="12" class="px-2 py-2 text-center text-gray-600">No se encontraron solicitudes.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>