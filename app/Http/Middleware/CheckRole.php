<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$role) // Menggunakan ... untuk menerima banyak peran
    {
        if ($request->user() && in_array($request->user()->role, $role)) {
            return $next($request);
        }

        return redirect('login'); // Atau halaman yang sesuai
    }
}

