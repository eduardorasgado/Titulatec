<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsJefeOAdmin
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
                if(Auth::user()->id_role == Role::$ROLE_JEFE_ACADEMIA || Auth::user()->id_role == Role::$ROLE_ADMIN){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
    }
}
