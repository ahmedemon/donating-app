<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    function __construct()
    {
        $this->redirectTo = env('ADMIN_URL_PREFIX', 'admin');
        $this->middleware('admin.guest')->except('logout');
    }



    public function viewLogin()
    {
        $pageTitle = "Admin Login";
        return view('admin.login', compact('pageTitle'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function login(Request $request)
    {
        // return $request->all();
        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        // $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/admin');
    }
}