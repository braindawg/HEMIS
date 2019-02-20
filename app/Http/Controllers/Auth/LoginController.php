<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $guard = 'user';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/noticeboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login', ['guard' => $this->guard]);
    }

    protected function credentials($request)
    {
        return array_merge($request->only($this->username(), 'password'), ['active' => 1]);
    }

    protected function guard()
    {
        return auth()->guard($this->guard);
    }
}
