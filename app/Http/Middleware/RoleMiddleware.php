<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response $next
     * @param string|null $role El rol requerido o null para validar que tenga cualquier rol
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        // Verifica que el usuario esté autenticado
        if (!$request->user()) {
            return redirect('/')->with('error', 'Acceso Denegado.');
        }

        // Si se especifica un rol, valida que el usuario tenga ese rol
        if ($role !== null) {
            if (!$request->user()->hasRole($role)) {
                return redirect('/')->with('error', 'Acceso Denegado.');
            }
        } else {
            // Si no se especifica, valida que el usuario tenga al menos un rol asignado
            if ($request->user()->getRoleNames()->isEmpty()) {
                return redirect('/')->with('error', 'Acceso Denegado. No tienes un rol asignado.');
            }
        }

        return $next($request);
    }
}
