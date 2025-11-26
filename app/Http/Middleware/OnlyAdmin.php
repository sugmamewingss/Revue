<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah peran (role) pengguna adalah 'admin'
        if (Auth::user()->role !== 'admin') {
            // Jika bukan admin, redirect kembali ke homepage atau tampilkan error 403
            return redirect()->route('homepage')->with('error', 'Akses ditolak. Hanya Admin yang diizinkan.');
        }

        return $next($request);
    }
}