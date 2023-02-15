<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth.owner')->only(['edit', 'update']);
    }


    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::query();

        if ($keyword = request('search')) {
            $users->where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%");
        }

        $users = $users->whereNot('id', 1)->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'regex:/^09[0-9]{9}$/', Rule::unique('users')->ignore($user->id)],
        ]);

        if ($request->has('admin'))
            $data['admin'] = true;
        else
            $data['admin'] = false;

        if (!! $request->password) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('toast.success', 'کاربر با موفیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:users']
        ]);

        $user = User::find($request->id);

        if ($user->is_admin())
            return redirect()->back()->with('toast.danger', 'نمیتوانید کاربر مدیر را حذف کنید!');

        $user->delete();

        return redirect()->back()->with('toast.success', 'کاربر با موفیت حذف شد');
    }
}
