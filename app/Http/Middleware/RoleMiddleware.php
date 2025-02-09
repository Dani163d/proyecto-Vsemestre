<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirigir al login si no está autenticado
        }

        // Verificar si el usuario tiene el rol requerido
        if (!Auth::user()->hasRole($role)) {
            abort(403, 'No tienes permiso para acceder a esta página.'); // Denegar acceso
        }

        return $next($request); // Permitir el acceso
    }
}