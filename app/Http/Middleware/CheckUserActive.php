<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
{
    // Si el usuario está autenticado pero NO está activo
    if (auth()->check() && auth()->user()->activo != 1) {
        auth()->logout(); // Lo desconectamos

        return redirect()->route('login')->withErrors([
            'email' => 'Tu cuenta está desactivada. Contacta al administrador.'
        ]);
    }

    return $next($request);
}
}
