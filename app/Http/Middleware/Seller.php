<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return (auth()->user()->role == 'seller')
        ? $next($request)
        : redirect()->route(auth()->user()->role)->with('error', "You don't have permission to access");
    }
}
