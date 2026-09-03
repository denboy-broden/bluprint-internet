<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware {
    public function handle(Request $request, Closure $next): Response {
        $token = $request->header('X-API-Token') ?? $request->bearerToken();
        $expected = env('API_TOKEN', 'rt-rw-net-secret-2026');
        if ($token === $expected) { return $next($request); }
        return response()->json(['error'=>'Unauthorized'], 401);
    }
}
