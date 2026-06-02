<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Importamos el modelo (Ajusta 'Rol' o 'Role' según como lo hayas creado)
use App\Models\Rol; 

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'id' => 1,
            'role_name' => 'Invitado'
        ]);

        Rol::create([
            'id' => 2,
            'role_name' => 'Usuario'
        ]);

        Rol::create([
            'id' => 3,
            'role_name' => 'Admin'
        ]);
    }
}