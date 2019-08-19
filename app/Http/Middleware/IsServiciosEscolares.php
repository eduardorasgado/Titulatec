<?php

namespace App\Http\Middleware;

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
                if(Auth::user()->id_role == 4){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
    }
}
