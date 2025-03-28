<x-app-layout>
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Editar Permiso: {{ $permission->name }}</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('seguridad.permisos.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre del Permiso:</label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name', $permission->name) }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                
                @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Actualizar Permiso
                </button>
                <a href="{{ route('seguridad.permisos.index') }}" class="text-gray-600 hover:text-gray-800 ml-4">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>