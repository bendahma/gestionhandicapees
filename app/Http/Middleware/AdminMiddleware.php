<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        if(!Auth::user()->isAdmin()){
            session()->flash('error','Vous N\'avez Pas Le Droit d\'Utiliser Cette Action.');
            return redirect(route('dashboard'));
        }
        return $next($request);
    }
}
