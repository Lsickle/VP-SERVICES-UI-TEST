<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operacion;
use Illuminate\Http\Request;

class OperacionController extends Controller
{
    /**
     * Muestra la lista de operaciones.
     */
    public function index()
    {
        $operaciones = Operacion::all();
        return view('operaciones.index', compact('operaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva operación.
     */
    public function create()
    {
        return view('operaciones.create');
    }

    /**
     * Almacena una nueva operación.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'bodega'      => 'required|string|max:255',
        ]);

        Operacion::create($data);

        return redirect()->route('operaciones.index')
            ->with('success', 'Operación creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una operación existente.
     */
    public function edit($id)
    {
        $operacion = Operacion::findOrFail($id);
        return view('operaciones.edit', compact('operacion'));
    }

    /**
     * Actualiza la operación.
     */
    public function update(Request $request, $id)
    {
        $operacion = Operacion::findOrFail($id);

        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'bodega'      => 'required|string|max:255',
        ]);

        $operacion->update($data);

        return redirect()->route('operaciones.index')
            ->with('success', 'Operación actualizada correctamente.');
    }

    /**
     * Elimina la operación.
     */
    public function destroy($id)
    {
        $operacion = Operacion::findOrFail($id);
        $operacion->delete();

        return redirect()->route('operaciones.index')
            ->with('success', 'Operación eliminada correctamente.');
    }
}
