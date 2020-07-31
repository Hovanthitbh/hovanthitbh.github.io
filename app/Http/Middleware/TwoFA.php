<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Auth;
session_start();

class TwoFA
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
        if(isset($_SESSION['retain_login'])){
            unset($_SESSION['retain_login']);
            return redirect('/verifyOTP');
        }else{
            return $next($request);
        }
    }
}
