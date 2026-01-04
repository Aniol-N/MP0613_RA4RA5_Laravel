<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     * If the request doesn't contain a valid URL (either `url` or `img_url`),
     * redirect back to the welcome page with an error message.
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->input('url') ?? $request->input('img_url');

        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            return redirect('/')->with('error', 'URL inválida o faltante. Por favor proporciona una URL válida.');
        }

        return $next($request);
    }
}
