<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class PasswordResetController extends Controller
{
    public function reset()
    {
        return view('auth.passwords.phone');
    }
}
