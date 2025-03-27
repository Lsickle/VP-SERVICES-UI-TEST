@extends('layouts.guest') {{-- Se usa el layout para invitados --}}

@section('content')
<div class="container mx-auto px-4 mt-5">
    <h2 class="text-2xl font-bold mb-6 text-center">Agendar Entrega</h2>
    
    <form action="{{ route('agendamiento.enviar') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_entrega" class="block font-bold">Fecha de Entrega:</label>
                <input type="date" name="fecha_entrega" id="fecha_entrega" required class="w-full p-2 border rounded">
            </div>
            
            <div>
                <label for="bodega" class="block font-bold">Bodega:</label>
                <input type="text" name="bodega" id="bodega" required class="w-full p-2 border rounded">
            </div>
            
            <div>
                <label for="op" class="block font-bold">OP:</label>
                <input type="text" name="op" id="op" required class="w-full p-2 border rounded">
            </div>


            <div>
                <label for="proveedor" class="block font-bold">Proveedor:</label>
                <input type="text" name="proveedor" id="proveedor" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="codigo_articulo" class="block font-bold">Código de Artículo:</label>
                <input type="text" name="codigo_articulo" id="codigo_articulo" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="nombre_articulo" class="block font-bold">Nombre del Artículo:</label>
                <input type="text" name="nombre_articulo" id="nombre_articulo" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="cantidades_pedidas" class="block font-bold">Cantidad Pedida:</label>
                <input type="number" name="cantidades_pedidas" id="cantidades_pedidas" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="placa" class="block font-bold">Placa:</label>
                <input type="text" name="placa" id="placa" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="conductor" class="block font-bold">Conductor:</label>
                <input type="text" name="conductor" id="conductor" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="cedula" class="block font-bold">Cédula del Conductor:</label>
                <input type="text" name="cedula" id="cedula" required class="w-full p-2 border rounded">
            </div>


            <div>
                <label for="correo_solicitante" class="block font-bold">Correo del Solicitante:</label>
                <input type="email" name="correo_solicitante" id="correo_solicitante" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="celular" class="block font-bold">Celular:</label>
                <input type="text" name="celular" id="celular" required class="w-full p-2 border rounded">
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Enviar Solicitud
            </button>
        </div>
    </form>
</div>
@endsection
