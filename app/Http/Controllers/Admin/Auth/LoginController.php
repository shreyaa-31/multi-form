<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

 
    protected $redirectTo = "Admin/dashboard";

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function attemptLogin(Request $request)
    {
        Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);

        if (Auth::guard('admin')->check()) {
            
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withErrors("Enter valid credentials");
        }
    }

    public function logout(Request $request)
    {

        $this->guard()->logout();
        return redirect()->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}