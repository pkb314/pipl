<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth()->check()) {
            return redirect()->route('login');
        }

        if (!empty($roles) && !in_array(Auth()->user()->role, $roles)) {
            abort(403, 'Brak uprawnień do tej strony.');
        }

        return $next($request);
    }
}
