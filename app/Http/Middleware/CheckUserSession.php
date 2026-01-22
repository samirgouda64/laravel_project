<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('user_code'))
        {
            return redirect('/');
        }
        return $next($request);
    }

}