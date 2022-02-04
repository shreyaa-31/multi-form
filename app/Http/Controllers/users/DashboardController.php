<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function showdashboard()
    {   
        
        return view('users.index');
    }
}
