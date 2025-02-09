<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Primero verifica si ya existe un género, si no, créalo
        $genero = \DB::table('generos')->first();
        
        if (!$genero) {
            // Si no existe ningún género, crea uno
            $generoId = \DB::table('generos')->insertGetId([
                'NombreGenero' => 'Masculino',
                // Agrega aquí cualquier otra columna requerida por tu tabla generos
            ]);
        } else {
            $generoId = $genero->idGenero;
        }

        // Crear el rol de admin si no existe
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);

        // Crear el usuario administrador
        $usuario = Usuario::create([
            'NombreUsuario' => 'Admin',
            'ApellidoUsuario' => 'Admin',
            'CorreoUsuario' => 'admin@example.com',
            'ContrasenaUsuario' => bcrypt('admin123'), 
            'FechaNacimientoUsuario' => '1990-01-01', 
            'CedulaUsuario' => 123456789, 
            'Generos_idGenero' => $generoId, // Usar el ID del género que existe
            'verificado' => 1,
        ]);

        // Asignar el rol de admin al usuario
        $usuario->assignRole($roleAdmin);

        $this->command->info('Usuario administrador creado correctamente.');
    }
}