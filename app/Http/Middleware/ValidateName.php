<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateName
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $name = $request->input('name');

        if (is_null($name) || trim($name) === '') {
            return redirect('/')->with('error', 'Nombre inválido o faltante. Por favor proporciona un nombre.');
        }

        return $next($request);
    }
}
