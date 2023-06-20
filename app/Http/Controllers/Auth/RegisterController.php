<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;

trait RegisterController
{

    /**
     * Show the application's register form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm () {
        return view('auth.registerForm');
    }

    /**
     * Handle a new registration request from the application
     *
     * @param  \App\Http\Request\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        Auth::guard()->login($user);

        Toast::success(trans("Account successfully registered."))
            ->backdrop()
            ->autoDismiss(5);

        return redirect()->intended($this->redirectLoginTo());
    }
    
}
