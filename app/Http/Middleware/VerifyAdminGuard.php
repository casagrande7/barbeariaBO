<?php

namespace App\Http\Middleware;

use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\Profissional;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user() instanceof Administrador) {
            return response()->json([
                'status' => false,
                'message' => 'Não é uma instância de ADM'
            ]);
        }
        return $next($request);
    }

    public function handle2(Request $request, Closure $next): Response
    {
        if (!auth()->user() instanceof Cliente) {
            return response()->json([
                'status' => false,
                'message' => 'Não é uma instância de Cliente'
            ]);
        }
        return $next($request);
    }
}
