<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Services\SellerService;
use Illuminate\Support\Facades\Auth;

class SellerAuthController extends Controller
{
    use LoginController;
    
    /**
     * Show the seller panel login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowLoginForm() {
        return view('seller.auth.login');
    }

    /**
     * Return the seller guard
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard () {
        return Auth::guard();
    }

    /**
     * Where to redirect after a success request
     * @return string
     */
    public function redirectLoginTo () {
        if($this->guard()->check()){
            if (!$this->guard()->user()->hasVerifiedEmail())
                return '/verify-email';
            else if (!SellerService::isStartUp())
                return '/seller-panel/pricing';
            else
                return '/seller-panel/dashboard';
        } else 
            return '/seller-panel/';
    }

    /**
     * 
     * Return the maximun attempts for the throttle Login rate limiter
     * 
     * @return int
     */
    protected function maxAttempts () {
        return 3;
    }

    /**
     * 
     * Return the decay minutes for the throttle Login rate limiter
     * 
     * @return int
     */
    protected function decayMinutes () {
        return 1;
    }
}
