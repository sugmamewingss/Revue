<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        
        return $next($request);
    }
}

// Jangan lupa register middleware ini di app/Http/Kernel.php
// Di dalam $middlewareAliases atau $routeMiddleware:
// 'admin' => \App\Http\Middleware\IsAdmin::class,