<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /** --------------- User Login
     * =================================================*/
    public function login(Request $request)
    {
        // return $request;
        if(Auth::attempt(['role' => $request->role, 'password' => $request->password]))
        {
            return to_route('home');
        }

        return back()->with('status', 'Password mismatched. Please try again');
    }




    /**-----------------    Logout
     * =================================================*/
    public function logout()
    {
        Auth::logout();
        return to_route('login.view');
    }

}
