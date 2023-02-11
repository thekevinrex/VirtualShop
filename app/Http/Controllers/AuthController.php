<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ConfirmController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Auth\VerifyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    use LoginController, RegisterController, ConfirmController, ResetController, VerifyController;
    
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

    public function redirectLoginTo () {
        return '/';
    }

    public function guard () {
        return Auth::guard();
    }

    public function broker () {
        return Password::broker('users');
    }
    
}
