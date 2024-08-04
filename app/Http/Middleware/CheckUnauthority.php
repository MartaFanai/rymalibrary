<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Illuminate\Support\Facades\Crypt;
use Closure;

class CheckUnauthority
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
        $path = config('checkunauthority.path');
        $hostName = gethostname();

        if (!Storage::exists($path)) 
        {
            Storage::put($path, $hostName);
            Setting::find(1)->update(['hostname' => encrypt($hostName)]);
        }

        $host = Setting::find(1)->value('hostname');

        if(is_null($host))
        {
            Setting::find(1)->update(['hostname' => encrypt($hostName)]);
        }
        
        // dd(decrypt($host));
        $check = decrypt($host);
        $match = Storage::get($path);

        if ($check != $match) {
            return redirect()->route('error.400');
        }

        return $next($request);
    }
}
