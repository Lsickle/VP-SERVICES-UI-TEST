<?php

namespace Database\Seeders;

use App\Models\Operacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recuperamos la operación "Tecnología" (ya creada por OperacionSeeder)
        $operacion =    Operacion::where('nombre', 'Tecnología')->first();

        // Crear un usuario Administrador con rol asignado y operación asignada
        $admin = User::factory()->create([
            'name'     => 'Administrador',
            'email'    => 'admin@example.com',
            'operacion_id' => $operacion ? $operacion->id : null,
            'password' => Hash::make('12345'),
        ]);
        $admin->assignRole('Administrador');

        // Crear un usuario Autorizador con rol asignado y operación asignada
        $autorizador = User::factory()->create([
            'name'     => 'Autorizador',
            'email'    => 'autorizador@example.com',
            'operacion_id' => $operacion ? $operacion->id : null,
            'password' => Hash::make('12345'),
        ]);
        $autorizador->assignRole('Autorizador');

        // Crear 30 usuarios de prueba
        User::factory()->count(10)->create();
    }
}
