<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$types): Response
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        if (!in_array($user->type, $types)) {
            abort(403);
        }
    return $next($request);

}

}