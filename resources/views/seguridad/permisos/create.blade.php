<x-app-layout>
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Permiso</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('seguridad.permisos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre del Permiso:</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
        </form>
    </div>
</div>
</x-app-layout>