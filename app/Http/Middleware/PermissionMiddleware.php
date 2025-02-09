<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission  El permiso que se requiere para acceder a la ruta.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirigir al login si no está autenticado
        }

        // Verificar si el usuario tiene el permiso requerido
        if (!Auth::user()->hasPermissionTo($permission)) {
            abort(403, 'No tienes permiso para acceder a esta página.'); // Denegar acceso
        }

        return $next($request); // Permitir el acceso
    }
}