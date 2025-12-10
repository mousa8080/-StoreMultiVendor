<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->header('x-api-key') !== config('app.api_key')){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API Token',
            ], 401);
        }
        return $next($request);
    }
}
