<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function showLoginForm()
    {

        return view('users.login');
    }
    public function attemptLogin(Request $request)
    {
        Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);

        if (Auth::guard('web')->check()) {
            
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->withErrors("Enter valid credentials");
        }
    }
}
