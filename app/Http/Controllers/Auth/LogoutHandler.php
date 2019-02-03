<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LogoutHandler extends Controller
{
    use AuthenticatesUsers;

    public function __invoke(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return 'Logged out';
    }
}