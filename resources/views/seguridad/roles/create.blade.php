@extends('layouts.administradorlayout')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Rol</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('seguridad.roles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre del Rol:</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Permisos:</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach($permissions as $permission)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-checkbox">
                        <span class="ml-2">{{ $permission->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
        </form>
    </div>
</div>
@endsection