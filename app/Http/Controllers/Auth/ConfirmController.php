<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

trait ConfirmController
{
 
    /**
     * 
     * Show the application confirm password form 
     * 
     * @return \Illuminate\View\View
     */
    public function showPasswordConfirmForm  () {
        return view('auth.password-confirm');
    }

    /**
     * 
     * Handle a request to confirm the user password
     * 
     * @params \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordConfirm (Request $request) {

        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendFailLoginAttempts ($request);
        }

        if (Hash::check($request->password, $request->user()->password)) {
            $request->session()->put('auth.password_confirmed_at', time());
            $this->clearLoginAttempts($request);
            return redirect()->intended($this->redirectLoginTo());
        }

        $this->incrementLoginAttempts($request);
        throw ValidationException::withMessages([
            'passwrod' => [trans('auth.failed')],
        ]);
    }


}
