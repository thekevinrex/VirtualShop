<?php

namespace App\Http\Middleware;

use App\Services\SellerService;
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
        if (!SellerService::isStartUp()) {
            return redirect()->route('seller.pricing');
        } else 
            return $next($request);
    }
}
