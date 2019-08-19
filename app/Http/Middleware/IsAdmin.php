<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class isAdmin
 * Comprueba que el usuario en efecto es un administrador
 * @package App\Http\Middleware
 */
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // en caso de no estar logueado
        if(Auth::guest()) { return redirect('/'); }
        else {
            if(Auth::check()) {
                if(Auth::user()->id_role == Role::$ROLE_ADMIN){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }

    }
}
