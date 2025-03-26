<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        //Funcion para listar o mostrar todos los permisos
        $permissions = Permission::all();
        return view('seguridad.permisos.index', compact('permissions'));
    }
    public function create()
    {
        //Función para mostrar el fomulario de creación de un nuevo permiso
        return view('seguridad.permisos.create');
    }
    public function store(Request $request)
    {
        //Función para almacenar un nuevo permiso
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);
        //validar

        Permission::create(['name' => $request->name]);

        return redirect()->route('seguridad.permisos.index')
            ->with('success', 'Permiso creado correctamente.');
    }
    public function edit($id)
    {
        //Función para mostrar el formulario de editar un permiso
        $permission = Permission::findOrFail($id);
        return view('seguridad.permisos.edit', compact('permission'));
    }
    public function update(Request $request, $id)
    {
        //Función para actualizar el permiso
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $permission->id
        ]);

        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('seguridad.permisos.index')->with('Permiso actualizado correctamente');
    }
    public function destroy($id)
    {
        //Función para eliminar un permiso
        $permission = Permission::FindOrFail($id);
        $permission->delete();

        return redirect()->route('seguridad.permisos.index')->with('Permiso eliminado correctamente.');
    }
}
