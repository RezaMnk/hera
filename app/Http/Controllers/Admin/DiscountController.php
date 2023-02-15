<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;

class DiscountController extends Controller
{
    /**
     * Display a listing of the discounts.
     *
     * @return View
     */
    public function index()
    {
        $discounts = Discount::query();

        if ($keyword = request('search')) {
            $discounts->where('name', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%");
        }

        $discounts = $discounts->latest()->paginate(20);
        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('discounts')->whereNull('deleted_at')],
            'type' => ['required', 'in:static,percent'],
            'value' => ['required', 'numeric'],
            'expire_at' => ['required', 'string', 'date'],
        ]);

        $request->merge(['expire_at' => Jalalian::fromFormat('Y/m/d', $request->expire_at)
            ->addDays()->subSeconds()->toCarbon()->toDateTimeString()]);

        Discount::create($request->all());

        return redirect()->route('admin.discounts.index')->with('toast.success', 'کد تخفیف با موفیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Discount $discount
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Discount $discount)
    {
        $discounts = Discount::query()->latest()->paginate(20);
        return view('admin.discounts.index', compact('discount', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Discount $discount
     * @return RedirectResponse
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('discounts')->whereNull('deleted_at')->ignore($discount->id)],
            'type' => ['required', 'in:static,percent'],
            'value' => ['required', 'numeric'],
            'expire_at' => ['required', 'string', 'date'],
        ]);

        $request->merge(['expire_at' => Jalalian::fromFormat('Y/m/d', $request->expire_at)
            ->addDays()->subSeconds()->toCarbon()->toDateTimeString()]);

        $discount->update($request->all());

        return redirect()->route('admin.discounts.index')->with('toast.success', 'کد تخفیف با موفیت ویرایش شد');
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
            'id' => ['required', 'exists:discounts']
        ]);

        if ($request->id == 1)
            return back();

        $discount = Discount::find($request->id);

        $discount->delete();

        return redirect()->back()->with('toast.success', 'کد تخفیف با موفیت حذف شد');
    }
}
