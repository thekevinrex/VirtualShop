<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ConfirmController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Auth\VerifyController;

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
    
}
