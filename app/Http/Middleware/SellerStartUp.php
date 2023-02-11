<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellerStartUp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->data) {
            return redirect()->route('seller.start-up');
        } else 
            return $next($request);
    }
}
