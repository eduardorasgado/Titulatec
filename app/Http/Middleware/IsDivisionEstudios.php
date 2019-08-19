<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class IsDivisionEstudios
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
        if(Auth::guest()) { return redirect('/'); }
        else {
            if(Auth::check()) {
                // si es secretaria o jefe de division entonces puede acceder
                if(Auth::user()->id_role == Role::$ROLE_SECRETARIA_DIVISION
                    || Auth::user()->id_role == Role::$ROLE_JEFE_DIVISION){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
    }
}
