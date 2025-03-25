<?php

namespace Database\Seeders;

use App\Models\Operacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Operacion::create([
            'nombre'      => 'Tecnología',
            'bodega'      => 'Bodega 12g', // ajusta según tus datos
        ]);
    }
}
