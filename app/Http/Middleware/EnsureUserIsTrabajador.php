<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTrabajador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->ID_Tipo == 2) {
            return $next($request);
        }

        // Si no es un administrador, redirigir a una página de error o a la página de inicio
        return redirect('/')->withErrors(['message' => 'No tienes permiso para acceder a esta página.']);
    }
}
