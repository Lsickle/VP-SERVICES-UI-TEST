<!-- resources/views/solicitudes/formato-descarga/pendientes.blade.php -->
<x-app-layout>
    <div class="container mx-auto py-10" x-data="{ openCard: null, search: '' }">

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 mb-6">Solicitudes Pendientes</h2>

        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <input type="text" x-model="search" placeholder="Buscar solicitudes..."
                class="w-full p-2 border rounded text-sm" />
        </div>

        <!-- Contenedor para slider horizontal en móvil -->
        <div class="overflow-x-auto">
            <!-- Tabla de solicitudes pendientes -->
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
                        <th class="px-2 py-2 border-b border-gray-300">Acciones</th>
                        <th class="px-2 py-2 border-b border-gray-300">Fecha Creación</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Se muestran solo las solicitudes pendientes -->
                    @foreach($pendientes as $solicitud)
                    <template x-if="'{{ $solicitud['op'] }}'.toLowerCase().includes(search.toLowerCase()) || 
                                    '{{ $solicitud['proveedor'] }}'.toLowerCase().includes(search.toLowerCase())">
                        <tr>
                            <td class="px-2 py-2 text-center">{{
                                \Carbon\Carbon::parse($solicitud['fecha_entrega'])->format('d/m/Y') }}</td>
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
                            <td class="px-2 py-2 text-center">
                                <!-- Botones para aprobar o rechazar -->
                                <button x-on:click="openCard = 'aprobar-{{ $solicitud['id'] }}'"
                                    class="text-green-600 hover:underline">
                                    Aprobar
                                </button>
                                |
                                <button x-on:click="openCard = 'rechazar-{{ $solicitud['id'] }}'"
                                    class="text-red-600 hover:underline">
                                    Rechazar
                                </button>
                            </td>
                            <td class="px-2 py-2">{{ \Carbon\Carbon::parse($solicitud['created_at'])->format('d/m/Y') }}
                            </td>
                        </tr>
                    </template>
                    @endforeach
                    @if(empty($pendientes))
                    <tr>
                        <td colspan="13" class="px-2 py-2 text-center text-gray-600">No se encontraron solicitudes
                            pendientes.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Card dinámico para aprobar o rechazar (compatible en móvil) -->
        <div x-show="openCard !== null" class="mt-6 p-4 md:p-6 bg-white border rounded-lg shadow-lg" x-cloak>
            <!-- Formulario para aprobación -->
            <template x-if="openCard.startsWith('aprobar-')">
                <div>
                    <h3 class="text-lg font-bold mb-4">Aprobar Solicitud</h3>
                    <form method="POST" :action="getFormAction()" x-on:submit.prevent="$el.submit()">
                        @csrf
                        @method('PUT')
                        <!-- Campo oculto para estatus aprobada -->
                        <input type="hidden" name="estatus" value="aprobada">
                        <!-- Campo oculto para el autorizador (se asigna el nombre del usuario autenticado) -->
                        <input type="hidden" name="autorizador" value="{{ Auth::user()->name }}">
                        <div class="mb-4">
                            <label for="fecha_programada_entrega" class="block text-sm font-medium text-gray-700">
                                Fecha Programada de Entrega
                            </label>
                            <input type="date" name="fecha_programada_entrega" id="fecha_programada_entrega"
                                class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="texto_respuesta_correo" class="block text-sm font-medium text-gray-700">
                                Texto de Respuesta
                            </label>
                            <textarea name="texto_respuesta_correo" id="texto_respuesta_correo" rows="3"
                                class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-end">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded mb-2 sm:mb-0">
                                Confirmar Aprobación
                            </button>
                            <button type="button" x-on:click="openCard = null" class="sm:ml-4 text-gray-600">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </template>

            <!-- Formulario para rechazo -->
            <template x-if="openCard.startsWith('rechazar-')">
                <div>
                    <h3 class="text-lg font-bold mb-4">Rechazar Solicitud</h3>
                    <form method="POST" :action="getFormAction()" x-on:submit.prevent="$el.submit()">
                        @csrf
                        @method('PUT')
                        <!-- Campo oculto para estatus rechazada -->
                        <input type="hidden" name="estatus" value="rechazada">
                        <!-- Campo oculto para el autorizador -->
                        <input type="hidden" name="autorizador" value="{{ Auth::user()->name }}">
                        <div class="mb-4">
                            <label for="texto_respuesta_correo_rechazo" class="block text-sm font-medium text-gray-700">
                                Motivo del Rechazo
                            </label>
                            <textarea name="texto_respuesta_correo" id="texto_respuesta_correo_rechazo" rows="3"
                                class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-end">
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded mb-2 sm:mb-0">
                                Confirmar Rechazo
                            </button>
                            <button type="button" x-on:click="openCard = null" class="sm:ml-4 text-gray-600">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>