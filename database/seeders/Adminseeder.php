<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'name' => 'Administrador',
    'email' => 'admin@admin.com',
    'password' => Hash::make('Admin12345'),
    'role_id' => 3
]);
    }
}
