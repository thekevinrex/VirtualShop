<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

trait ResetController
{
    
    /**
     * 
     * Show the application forgot password form
     * 
     * @return \Illuminate\View\View
     */
    public function ShowForgotPasswordForm () {
        return view('auth.password.email');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowResetPasswordForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('auth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * 
    * Send the email reset link token
    * 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\RedirectResponse
    */

    public function SendResetEmailToken (Request $request) {
        
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : throw ValidationException::withMessages([
                    'email' => [__($status)],
                ]);
    }

    
    /**
     * Handle a request to reset the user password
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Validation\ValidationException
     */

    public function resetPassword (Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                RulesPassword::min(8)->mixedCase ()->numbers ()->symbols (),
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $this->resetPasswordSuccess($user, $password);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('home')->with('status', __($status))
            : throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
    }

    /**
     * 
     * Force the updated password to the user data, and update the database
     * 
     * @params \App\Models\User $user|\String $password
     * 
     */
    private function resetPasswordSuccess ($user, $password) {
    
        $user->forceFill([
            'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        Auth::guard()->login($user);
    }

}
