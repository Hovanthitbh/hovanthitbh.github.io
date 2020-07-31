<?php

namespace App\Http\Middleware;

use Closure;

class IsVerified
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
        if(isset($_SESSION['OTP'])){
            $_SESSION['retain_login'] = $_SESSION['OTP'];
            return $next($request);
        }
        return $next($request);
    }
}
