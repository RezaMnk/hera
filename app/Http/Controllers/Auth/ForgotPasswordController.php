<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.phone');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetCodePhone(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'numeric', 'regex:/^09[0-9]{9}$/', 'exists:users']
        ]);

        session()->flash('user', [
            'user_id' => User::firstWhere('phone', $request->phone)->id,
            'forgot_password' => true,
        ]);

        return redirect()->route('2fa.index');
    }
}
