<?php

namespace App\Http\Middleware;

use Closure;

class IsUser
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
        if(!auth()->guard('user')->check()){
            return redirect(route('sign-in'));;
        }
        $lifetime = 2;
        config(['session.lifetime' => $lifetime]);
        return $next($request);
    }
}
