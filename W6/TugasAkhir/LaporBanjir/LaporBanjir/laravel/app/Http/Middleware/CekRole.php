<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()->role !== $role) {
            abort(403, 'Halaman ini khusus untuk ' . $role . '.');
        }
        return $next($request);
    }
}
