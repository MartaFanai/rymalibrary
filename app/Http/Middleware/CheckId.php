<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Request;
use Closure;

class CheckId
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
        $randomId = $request->route('user') ?? $request->route('id');

        if(is_object($randomId))
            $randomId = $randomId->id;
        
        $referer = $request->server('HTTP_REFERER');

        if (str_contains($referer, 'create')) {
            return $next($request);
        } 

        if ($randomId <= 1) {
            // return redirect()->route('users.index');
            return $next($request);
        }

        return $next($request);
        // return redirect()->route('home')->with('warning', 'Not allowed to access');
    }
}
