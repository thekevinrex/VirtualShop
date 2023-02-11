<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Auth\ConfirmController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class SellerAuthController extends Controller
{
    use LoginController, ConfirmController, ResetController;
    
    public function register (Request $request) {

        $credentials = $request->validate([
            'email' => 'required|string|email|unique:sellers,email',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        $user = Seller::create($credentials);

        event(new Registered($user));

        $this->guard()->login($user);

        return redirect()->intended('seller-panel/verify-email')->with('success', "Account successfully registered.");
    }

    public function ShowLoginForm() {
        return view('seller.auth.login');
    }

    public function ShowRegisterForm(){
        return view('seller.auth.register');
    }

    public function showResendVerificationEmail () {
        return view('seller.auth.verify-email');
    }

    public function showPasswordConfirmForm () {
        return view('seller.auth.password-confirm');
    }
    
    public function ShowForgotPasswordForm () {
        return view('seller.auth.reset-email');
    }

    public function ShowResetPasswordForm (Request $request) {
        $token = $request->route()->parameter('token');

        return view('seller.auth.password-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended('/seller-panel')->with('message', 'The email verification was a success');
    }

    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function guard () {
        return Auth::guard('seller');
    }

    public function broker () {
        return \Illuminate\Support\Facades\Password::broker('sellers');
    }

    public function redirectLoginTo () {
        if($this->guard()->check()){
            if ($this->guard()->user()->hasVerifiedEmail())
                return '/seller-panel';
            else
                return '/seller-panel/verify-email';
        } else 
            return '/seller-panel/login';
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
