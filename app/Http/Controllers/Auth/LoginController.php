<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

trait LoginController
{
    use ThrottleLogin;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm () {
        return view('auth.loginForm');
    }

    /**
     * Handle a request to attempt to login a user
     * 
     * @param \App\Http\Requests\LoginRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendFailLoginAttempts ($request);
        }

        if($this->guard()->attempt(
            $credentials, $request->boolean('remember_me')
        )) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return redirect()->intended($this->redirectLoginTo());
        }

        $this->incrementLoginAttempts($request);
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    /**
     * 
     * Logout the user from the aplication
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
    
        // $request->session()->flush();
        // $request->session()->regenerateToken();
    
        return redirect($this->redirectLoginTo());
    }

}
