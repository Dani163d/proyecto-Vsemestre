<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;  
use App\Models\Usuario;
use App\Models\Genero;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegistroController extends Controller
{
    public function showRegistrationForm()
    {
        $generos = Genero::all();
        return view('registro', compact('generos'));
    } 

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NombreUsuario' => 'required|string|max:255',
            'ApellidoUsuario' => 'required|string|max:255',
            'CorreoUsuario' => 'required|email|unique:usuarios,CorreoUsuario',
            'ContrasenaUsuario' => 'required|string|min:8|confirmed',
            'FechaNacimientoUsuario' => 'required|date',
            'CedulaUsuario' => 'required|numeric|unique:usuarios,CedulaUsuario',
            'Generos_idGenero' => 'required|exists:generos,idGenero',
            'FechaNacimientoUsuario' => 'required|date|before_or_equal:' . now()->subYears(15)->toDateString(),
        ], [
            'NombreUsuario.required' => 'El nombre de usuario es obligatorio.',
            'NombreUsuario.string' => 'El nombre de usuario debe ser un texto.',
            'NombreUsuario.max' => 'El nombre de usuario no puede exceder los 255 caracteres.',
            
            'ApellidoUsuario.required' => 'El apellido de usuario es obligatorio.',
            'ApellidoUsuario.string' => 'El apellido de usuario debe ser un texto.',
            'ApellidoUsuario.max' => 'El apellido de usuario no puede exceder los 255 caracteres.',
            
            'CorreoUsuario.required' => 'El correo electrónico es obligatorio.',
            'CorreoUsuario.email' => 'El correo electrónico debe tener un formato válido.',
            'CorreoUsuario.unique' => 'El correo electrónico ya está registrado.',
            
            'ContrasenaUsuario.required' => 'La contraseña es obligatoria.',
            'ContrasenaUsuario.string' => 'La contraseña debe ser un texto.',
            'ContrasenaUsuario.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'ContrasenaUsuario.confirmed' => 'Las contraseñas no coinciden.',
            
            'FechaNacimientoUsuario.required' => 'La fecha de nacimiento es obligatoria.',
            'FechaNacimientoUsuario.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            
            'CedulaUsuario.required' => 'La cédula es obligatoria.',
            'CedulaUsuario.numeric' => 'La cédula debe ser un número.',
            'CedulaUsuario.unique' => 'La cédula ingresada ya está registrada. Por favor, ingrese una cédula diferente.',
            
            'Generos_idGenero.required' => 'El género es obligatorio.',
            'Generos_idGenero.exists' => 'El género seleccionado no es válido.',
            
            'FechaNacimientoUsuario' => 'Usted no cumple con el requisito de edad para registrarse',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $usuario = Usuario::create([
            'NombreUsuario' => $request->NombreUsuario,
            'ApellidoUsuario' => $request->ApellidoUsuario,
            'CorreoUsuario' => $request->CorreoUsuario,
            'ContrasenaUsuario' => Hash::make($request->ContrasenaUsuario),
            'FechaNacimientoUsuario' => $request->FechaNacimientoUsuario,
            'CedulaUsuario' => $request->CedulaUsuario,
            'Generos_idGenero' => $request->Generos_idGenero,
            'verificado' => 0,  
        ]);
    
        if (!$usuario || !$usuario->idUsuario) {  
            return redirect()->back()->with('error', 'Error al crear el usuario');
        }

        $token = Token::create([
            'Usuarios_idUsuario' => $usuario->idUsuario,
            'Token' => Str::random(64),
            'TipoToken' => 'verify',  
            'TiempoExpiracion' => now()->addHours(24),  
            'Usado' => 0,  
        ]);

        Mail::to($usuario->CorreoUsuario)->send(new VerifyEmail($usuario, $token->Token));

        return redirect()->route('registro')->with('success', 'Por favor revisa tu email para verificar tu cuenta.');
    }

    public function verificarCorreo(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
            ]);

            $tokenRecord = Token::where('Token', $request->token)
                ->where('TipoToken', 'verify')  
                ->where('Usado', 0) 
                ->first();

            if (!$tokenRecord) {
                return redirect()->route('registro')->with('error', 'Token inválido o ya utilizado');
            }

            if ($tokenRecord->TiempoExpiracion < now()) {
                return redirect()->route('registro')->with('error', 'El token ha expirado');
            }

            $usuario = Usuario::find($tokenRecord->Usuarios_idUsuario);

            if (!$usuario) {
                return redirect()->route('registro')->with('error', 'Usuario no encontrado');
            }

            $usuario->update([
                'verificado' => 1,  
            ]);

            $tokenRecord->update(['Usado' => 1]);

            return redirect()->route('registro')->with('verify_success', 'Correo electrónico verificado correctamente. Ahora puedes iniciar sesión.');
            
        } catch (\Exception $e) {
            return redirect()->route('registro')->with('error', 'Error al verificar el correo: ' . $e->getMessage());
        }
    }
}