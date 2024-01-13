<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        /// jika role middleware adalah admin namun is_admin adalah false, maka abort
        /// jika role middleware adalah user namun is_admin adalah true, maka abort
        if (($role == 'admin' && !$user->is_admin) || ($role == 'user' && $user->is_admin)) {
            abort(403);
        }

        return $next($request);
    }
}
