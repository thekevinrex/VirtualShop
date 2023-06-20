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

        $this->authorize('viewVerificationPages', User::class);

        return view('auth.verify-email');
     }

     public function showVerificationSuccess () {
        return view('auth.verification-success');
     }

    /**
     * 
     * Handle a request to verify the user email
     * 
     * @param Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request) {

        $this->authorize('viewVerificationPages', User::class);

        $request->fulfill();

        return redirect()->route('verification.success');
    }

    public function resend (Request $request) {

        $this->authorize('viewVerificationPages', User::class);

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', trans('Verification link sent!') );
    }
}
