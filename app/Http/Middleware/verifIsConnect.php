<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifIsConnect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            // L'utilisateur est authentifié
            return $next($request);
        } else {
            // L'utilisateur n'est pas authentifié
            return response(view('auth.login')); // Wrap the view in a response
        }
    }
}
