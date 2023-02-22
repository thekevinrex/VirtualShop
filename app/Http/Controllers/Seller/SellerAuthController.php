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
use ProtoneMedia\Splade\Facades\Toast;

class SellerAuthController extends Controller
{
    use LoginController, ConfirmController, ResetController;
    
    /**
     * Handle a request to register a new seller account
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        Toast::title("Account successfully registered.")
            ->leftBottom();

        return redirect()->intended('seller-panel/verify-email');
    }

    /**
     * Show the seller panel login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowLoginForm() {
        return view('seller.auth.login');
    }

    /**
     * Show the seller panel register form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowRegisterForm(){
        return view('seller.auth.register');
    }

    /**
     * Show the seller panel verify email form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showResendVerificationEmail () {
        return view('seller.auth.verify-email');
    }

    /**
     * Show the seller panel password confirm form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPasswordConfirmForm () {
        return view('seller.auth.password-confirm');
    }
    
    /**
     * Show the seller panel forgot password form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowForgotPasswordForm () {
        return view('seller.auth.reset-email');
    }

    /**
     * Show the the seller panel reset password form
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function ShowResetPasswordForm (Request $request) {
        $token = $request->route()->parameter('token');

        return view('seller.auth.password-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle a request to verify the seller email
     * @param EmailVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        Toast::title('The email verification was a success')
            ->leftBottom ()
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->to($this->redirectLoginTo());
    }

    /**
     * Resend the seller verification email
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->back()->with('status', 'Verification link sent!');
    }

    /**
     * Return the seller guard
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard () {
        return Auth::guard('seller');
    }

    /**
     * Return the seller password broker
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker () {
        return \Illuminate\Support\Facades\Password::broker('sellers');
    }

    /**
     * Where to redirect after a success request
     * @return string
     */
    public function redirectLoginTo () {
        if($this->guard()->check()){
            if (!$this->guard()->user()->hasVerifiedEmail())
                return '/seller-panel/verify-email';
            else if ($this->guard()->user()->isNotStartUp())
                return '/seller-panel/pricing';
            else
                return '/seller-panel/dashboard';
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
