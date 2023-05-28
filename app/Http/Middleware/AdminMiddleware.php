<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
            switch ($request->path()) {
            default:
                if (auth()->user() && in_array(auth()->user()->rol, array('A','E'))) {
                    return $next($request);
                }
                break;
        }

        return redirect('/')->with('error', 'Acceso denegado');
    }
}
