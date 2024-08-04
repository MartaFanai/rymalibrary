<?php

namespace App\Http\Middleware;

use Closure;

class CheckPasscode
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
        $passcode = $request->query('code');
        $phrase = config('checkunauthority.passcode');

        if ($passcode !== $phrase) {
            return redirect('/checking');
        }

        return $next($request);
    }
}
