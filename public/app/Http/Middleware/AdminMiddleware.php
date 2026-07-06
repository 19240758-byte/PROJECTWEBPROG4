<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek role admin
        if (Auth::user()->profile?->role !== 'admin') {
            abort(403, 'Akses Super Admin hanya untuk role admin!');
        }

        return $next($request);
    }
}
