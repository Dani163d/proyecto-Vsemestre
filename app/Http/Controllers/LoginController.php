<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Función de login
    public function login(Request $request)
    {
        $request->validate([
            'CorreoUsuario' => 'required|email',
            'ContrasenaUsuario' => 'required'
        ]);

        $usuario = Usuario::where('CorreoUsuario', $request->CorreoUsuario)->first();

        if ($usuario) {
            // Verificar si el usuario está verificado
            if ($usuario->verificado == 0) {
                return back()->withErrors([
                    'CorreoUsuario' => 'Debes verificar tu correo electrónico antes de iniciar sesión.'
                ])->withInput();
            }

            if (Hash::check($request->ContrasenaUsuario, $usuario->ContrasenaUsuario)) {
                session([
                    'usuario_id' => $usuario->idUsuario,
                    'usuario_nombre' => $usuario->NombreUsuario,
                    'usuario_email' => $usuario->CorreoUsuario
                ]);

                // Redirigir al dashboard si el usuario es admin
                if ($usuario->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                }

                // Redirigir al perfil si el usuario no es admin
                return redirect()->route('perfil');
            }
        }

        return back()->withErrors([
            'CorreoUsuario' => 'Credenciales incorrectas'
        ])->withInput();
    }

    // Función para el dashboard del administrador
    public function adminDashboard()
    {
        return view('admin.dashboard'); // Vista del dashboard del admin
    }
}