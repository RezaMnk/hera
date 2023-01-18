<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\User;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        session()->keep('discount');

        $request->validate([
            'id' => ['required', 'exists:maps'],
            'lat' => ['required', 'numeric', 'max:255'],
            'long' => ['required', 'numeric', 'max:255'],
            'main_street' => ['required', 'string', 'max:255'],
            'side_street' => ['nullable', 'string', 'max:255'],
            'alley' => ['nullable', 'string', 'max:255'],
            'house_no' => ['required', 'numeric', 'min:1'],
        ]);

        $user->maps()->find($request->id)->update($request->all());

        return redirect()->back()->with('toast.success', 'آدرس با موفقیت بروزرسانی شد');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        session()->keep('discount');

        $request->validate([
            'lat' => ['required', 'numeric', 'max:255'],
            'long' => ['required', 'numeric', 'max:255'],
            'main_street' => ['required', 'string', 'max:255'],
            'side_street' => ['nullable', 'string', 'max:255'],
            'alley' => ['nullable', 'string', 'max:255'],
            'house_no' => ['required', 'numeric', 'min:1'],
        ]);

        if ($user->maps->count() >= 5)
            return redirect()->back()->with('toast.danger', 'شما می توانید تا 5 آدرس را ثبت کنید');

        $user->maps()->create($request->all());

        return redirect()->back()->with('toast.success', 'آدرس با موفقیت بروزرسانی شد');
    }
}
