<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        //dd(auth()->user()->role_id);
        $roles = [
            'admin' => [1],
            'user' => [1, 2],
        ];

        $roleIds = $roles[$role] ?? [];

        if(!in_array(auth()->user()->role_id, $roleIds)) {
            return abort(403); //Página não autorizado
        }
        return $next($request); //Povilas: abort(403); //Página não autorizado
    }
}
