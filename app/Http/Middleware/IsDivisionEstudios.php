<?php

namespace App\Http\Middleware;

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
                if(Auth::user()->id_role == 3 || Auth::user()->id_role == 7){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
    }
}
