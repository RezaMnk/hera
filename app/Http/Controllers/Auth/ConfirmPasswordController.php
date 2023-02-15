<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display the password confirmation view.
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function showConfirmForm()
    {
        session()->reflash();

        if (! session()->has('user.forgot_password'))
            return redirect('login');

        return view('auth.passwords.confirm');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail(session()->get('user.user_id'));

        $user->update([
            'password' => $request->password
        ]);

        auth()->loginUsingId($user->id, session()->get('user.user_id'));

        return redirect()->route('home.home')->with('toast.success', 'کلمه عبور با موفقیت تغییر یافت');
    }
}
