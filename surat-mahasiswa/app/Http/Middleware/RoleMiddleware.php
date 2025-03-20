<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Debugging: Cek apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'Anda belum login.');
        }

        // Debugging: Cek apakah user memiliki role yang sesuai
        if (Auth::user()->userable_type !== $role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
