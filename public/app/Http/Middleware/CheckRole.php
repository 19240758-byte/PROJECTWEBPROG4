<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user login dan punya role yang sesuai
        if (!auth()->check() || !in_array($request->user()->role, $roles)) {
            abort(403, 'Anda tidak diizinkan mengakses fitur ini.');
        }

        return $next($request);
    }
}
