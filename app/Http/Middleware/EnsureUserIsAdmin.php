<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->ID_Tipo == 1) {
            return $next($request);
        }

        // Si no es un administrador, redirigir a una página de error o a la página de inicio
        return redirect('/')->withErrors(['message' => 'No tienes permiso para acceder a esta página.']);
    }
}


