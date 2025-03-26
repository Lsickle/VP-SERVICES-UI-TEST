<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        //Función para mostrar la lista de Roles
        $roles = Role::all();
        return view('seguridad.roles.index', compact('roles'));
    }

    public function create()
    {
        //Función para mostrar el formulario de crear un nuevo Rol
        $permissions = Permission::all();
        //Para asignar un permiso al Rol, obtenemos todos los permisos existentes
        return view('seguridad.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        //Función para almacenar un nuevo Rol
        $request->validate([
            "name" => 'required|unique:roles,name'
        ]);

        $role = Role::create(['name' => $request->name]);

        //Si se han seleccionado permisos, se asginaran
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        //Si se creo el Rol dirigeremos al Usuario a nuestra vista con la lista de Roles junto con el mensaje de exito o 'success'
        return redirect()->route('seguridad.roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit($id)
    {
        //Función para mostrar el formulario de editar un Rol
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('seguridad.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        //Función para actualizar el Rol y sus permisos
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role->name = $request->name;
        $role->save();

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('seguridad.roles.index')->with('success', 'Rol actualizado  correctamente.');
    }

    public function destroy($id)
    {
        //Función para eliminar un Rol
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('seguridad.roles.index')->with('success', 'Rol Eliminado Correctamente.');
    }
}
