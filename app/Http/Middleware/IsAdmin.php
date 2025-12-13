<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
<<<<<<< Updated upstream
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
=======
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak. Hanya Admin yang diizinkan.');
>>>>>>> Stashed changes
        }
        
        return $next($request);
    }
}

// Jangan lupa register middleware ini di app/Http/Kernel.php
// Di dalam $middlewareAliases atau $routeMiddleware:
// 'admin' => \App\Http\Middleware\IsAdmin::class,