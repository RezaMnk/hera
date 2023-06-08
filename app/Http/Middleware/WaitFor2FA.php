<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WaitFor2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        session()->reflash();

        if (! $request->session()->has('user.user_id')) {
            return redirect()->route('login')->with(['toast.danger' => 'نشست منقضی شده است']);
        }

        return $next($request);
    }
}
