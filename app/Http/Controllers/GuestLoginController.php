<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    public function login(Request $request)
    {
        Auth::loginUsingId(1);
        return redirect()->intended('/');
    }
}
