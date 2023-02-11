<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait ThrottleLogin
{
    /**
     * Verify if the request has reached the max attempts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    protected function hasTooManyLoginAttempts (Request $request) {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    /**
     * Increment the attempts
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit(
            $this->throttleKey($request), $this->decayMinutes() * 60
        );
    }

    /**
     * Send the max attempts reached response
     *
     * @param  \Illuminate\Http\Request  $request
     * @throw  \Illuminate\Validation\ValidationException
     */
    protected function sendFailLoginAttempts(Request $request)
    {
        $seconds = RateLimiter::availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'username' => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ]);
    }

    /**
     * Clear the attempts
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Generate the throttle key for the rate limiter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  String
     */
    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('username')).'|'.$request->ip());
    }    
}
