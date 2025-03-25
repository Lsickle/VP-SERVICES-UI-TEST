<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /*
         * Definir permisos por módulos:
         */

        // Permisos para el módulo de Permisos
        Permission::create(['name' => 'Administrar Permisos']);

        // Permisos para el módulo de Roles
        Permission::create(['name' => 'Administrar Roles']);

        // Permisos para el módulo de Usuarios
        Permission::create(['name' => 'Administrar Usuarios']);

        // Permisos para el módulo de Operaciones
        Permission::create(['name' => 'Administrar Operaciones']);

        // Permiso para el modulo de Gestion Agendamientos
        Permission::create(['name' => 'Administrar Agendamientos']);

        /*
         * Crear roles y asignar permisos:
         */

        // Rol Administrador: acceso a todos los permisos
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        // Rol Autorizador: acceso a agendamientos
        $autorizador = Role::create(['name' => 'Autorizador']);
        $autorizador->givePermissionTo([
            // Agendamientos
            'Administrar Agendamientos',
        ]);
    }
}
