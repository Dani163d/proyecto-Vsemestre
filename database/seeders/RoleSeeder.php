<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Usuario;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol de admin si no existe
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol de admin al usuario admin
        $usuario = Usuario::where('CorreoUsuario', 'admin@example.com')->first();
        if ($usuario) {
            $usuario->assignRole($roleAdmin);
            $this->command->info('Rol de admin asignado al usuario admin.');
        } else {
            $this->command->error('Usuario admin no encontrado.');
        }
    }
}