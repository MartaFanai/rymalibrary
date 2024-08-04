<?php

namespace App\Http\Middleware;

use Closure;

class AdminOnly
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
        $user = $request->user();
        $targetUserId = $request->route('user');

        if($user && ($request->user()->role === 0 || $user->id == $targetUserId)){
            return $next($request);
        }

        return redirect()->route('home')->with('warning', 'Accessible by Administrators only');
    }
}
