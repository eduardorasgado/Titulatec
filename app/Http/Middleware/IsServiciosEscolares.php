<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class IsServiciosEscolares
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
                if(Auth::user()->id_role == Role::$ROLE_SERVICIOS_ESCOLARES){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
    }
}
