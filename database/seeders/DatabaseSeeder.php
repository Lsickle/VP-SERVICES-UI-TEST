<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Se ordenan los seeders para que al momento de ejecutarse no hayan inconvenientes con los atributos relacionados a otros seeders.

        // Primero, se ejecutan los roles y permisos
        $this->call(RoleAndPermissionSeeder::class);
        
        // Se ejecuta el seeder de la operación
        $this->call(OperacionSeeder::class);

        // Se ejecuta el seeder de usuarios
        $this->call(UserSeeder::class);
    }
}
