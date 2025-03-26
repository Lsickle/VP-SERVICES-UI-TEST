<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Operacion;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsuarioController extends Controller
{
    /**
     * Muestra la lista de usuarios junto con sus roles, operación y permisos.
     */
    public function index(Request $request)
    {
        // Creamos la consulta base con las relaciones necesarias
        $query = User::with('operacion', 'roles');

        // Si se envía un término de búsqueda, filtramos por nombre o correo
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Paginar los resultados, 10 usuarios por página
        $usuarios = $query->paginate(10);

        // Cargamos los roles, permisos y operaciones
        $roles = Role::all();
        $permissions = Permission::all();
        $operaciones = Operacion::all();

        return view('usuarios.index', compact('usuarios', 'roles', 'permissions', 'operaciones'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Se pasan los roles y operaciones para poblar los select
        $roles = Role::all();
        $operaciones = Operacion::all();

        return view('usuarios.create', compact('roles', 'operaciones'));
    }

    /**
     * Almacena el nuevo usuario.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6|confirmed',
            'role'         => 'required|string',              // Rol (nombre o slug)
            'operacion_id' => 'required|exists:operaciones,id', // Operación seleccionada
        ]);

        // Cifrar la contraseña
        $data['password'] = bcrypt($data['password']);

        // Crear el usuario (se asume que la tabla users tiene el campo operacion_id)
        $usuario = User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'password'     => $data['password'],
            'operacion_id' => $data['operacion_id'],
        ]);

        // Asignar el rol utilizando Spatie
        $usuario->assignRole($data['role']);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        $operaciones = Operacion::all();

        return view('usuarios.edit', compact('usuario', 'roles', 'permissions', 'operaciones'));
    }

    /**
     * Actualiza el usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Validar los datos. Si deseas actualizar también el rol, deberás incluirlo en la validación.
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $usuario->id,
            'operacion_id' => 'required|exists:operaciones,id',
            'role'         => 'sometimes|required|string', // Opcional, según si se actualiza el rol
            // Si se desea actualizar la contraseña, agregar validación para password y password_confirmation
        ]);

        $usuario->update($data);

        // Si se envía un nuevo rol, sincronizarlo:
        if ($request->filled('role')) {
            $usuario->syncRoles([$data['role']]);
        }

        // Opcional: Si se actualizan permisos, puedes sincronizarlos (suponiendo que se envíe un arreglo en 'permissions')
        if ($request->has('permissions')) {
            $usuario->syncPermissions($request->input('permissions'));
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina el usuario.
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
