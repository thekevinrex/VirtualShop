<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

trait VerifyController
{
    
    /**
     * 
     * Show the aplication verification needed view
     * 
     * @return \Illuminate\View\View
     */

     public function showResendVerificationEmail () {
        return view('auth.verify-email');
     }

    /**
     * 
     * Handle a request to verify the user email
     * 
     * @param Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended('')->with('message', 'The email verification was a success');
    }

    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
