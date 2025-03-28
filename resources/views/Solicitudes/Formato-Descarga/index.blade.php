<x-app-layout>
    <div class="container mx-auto py-10" x-data="{ openCard: null, search: '' }">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Gestión de Solicitudes de Agendamiento</h2>

        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <input type="text" x-model="search" placeholder="Buscar solicitudes..." class="w-full p-2 border rounded" />
        </div>

        <!-- Tabla de solicitudes -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">OP</th>
                    <th class="px-4 py-2">Proveedor</th>
                    <th class="px-4 py-2">Bodega</th>
                    <th class="px-4 py-2">Fecha Entrega</th>
                    <th class="px-4 py-2">Estatus</th>
                    <th class="px-4 py-2">Acciones</th>
                    <th class="px-4 py-2">Estatus</th>
                    <th class="px-4 py-2">Acciones</th>
                    <th class="px-4 py-2">Estatus</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Se filtran las solicitudes según el input de búsqueda -->
                @foreach($solicitudes as $solicitud)
                <template x-if="'{{ $solicitud['op'] }}'.toLowerCase().includes(search.toLowerCase()) || 
                                '{{ $solicitud['proveedor'] }}'.toLowerCase().includes(search.toLowerCase())">
                    <tr>
                        <td class="px-4 py-2">{{ $solicitud['op'] }}</td>
                        <td class="px-4 py-2">{{ $solicitud['proveedor'] }}</td>
                        <td class="px-4 py-2">{{ $solicitud['bodega'] }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($solicitud['fecha_entrega'])->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($solicitud['estatus']) }}</td>
                        <td class="px-4 py-2">
                            @if($solicitud['estatus'] == 'pendiente')
                                <!-- Botones para aprobar o rechazar que activan el card -->
                                <button x-on:click="openCard = 'aprobar-{{ $solicitud['id'] }}'" class="text-green-600 hover:underline">
                                    Aprobar
                                </button>
                                |
                                <button x-on:click="openCard = 'rechazar-{{ $solicitud['id'] }}'" class="text-red-600 hover:underline">
                                    Rechazar
                                </button>
                            @else
                                <span class="text-sm text-gray-500">Acción completada</span>
                            @endif
                        </td>
                    </tr>
                </template>
                @endforeach
                @if(empty($solicitudes))
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-600">No se encontraron solicitudes.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Card dinámico para aprobar o rechazar (se muestra cuando openCard no es null) -->
        <div x-show="openCard !== null" class="mt-6 p-6 bg-white border rounded-lg shadow-lg" x-cloak>
            <!-- Si openCard empieza con 'aprobar-', mostramos el formulario de aprobación -->
            <template x-if="openCard.startsWith('aprobar-')">
                <div>
                    <h3 class="text-lg font-bold mb-4">Aprobar Solicitud</h3>
                    <!-- Formulario para aprobar -->
                    <form method="POST" action="{{ route('solicitudes.update', '__ID__') }}" x-on:submit.prevent="$el.submit()">
                        @csrf
                        @method('PUT')
                        <!-- Campo oculto para estatus aprobada -->
                        <input type="hidden" name="estatus" value="aprobada">
                        <!-- Campo oculto para el autorizador -->
                        <input type="hidden" name="autorizador" value="{{ Auth::user()->name }}">
                        
                        <div class="mb-4">
                            <label for="fecha_programada_entrega" class="block text-sm font-medium text-gray-700">
                                Fecha Programada de Entrega
                            </label>
                            <input type="date" name="fecha_programada_entrega" id="fecha_programada_entrega" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="texto_respuesta_correo" class="block text-sm font-medium text-gray-700">
                                Texto de Respuesta
                            </label>
                            <textarea name="texto_respuesta_correo" id="texto_respuesta_correo" rows="3" class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                                Confirmar Aprobación
                            </button>
                            <button type="button" x-on:click="openCard = null" class="ml-4 text-gray-600">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </template>
            
            <!-- Si openCard empieza con 'rechazar-', mostramos el formulario de rechazo -->
            <template x-if="openCard.startsWith('rechazar-')">
                <div>
                    <h3 class="text-lg font-bold mb-4">Rechazar Solicitud</h3>
                    <!-- Formulario para rechazar -->
                    <form method="POST" action="{{ route('solicitudes.update', '__ID__') }}" x-on:submit.prevent="$el.submit()">
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
                            <textarea name="texto_respuesta_correo" id="texto_respuesta_correo_rechazo" rows="3" class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                                Confirmar Rechazo
                            </button>
                            <button type="button" x-on:click="openCard = null" class="ml-4 text-gray-600">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>