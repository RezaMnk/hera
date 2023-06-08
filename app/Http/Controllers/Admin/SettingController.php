<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        // Middleware only applied to these methods
        $this->middleware('auth.owner');
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $settings = Setting::orderBy('created_at', 'asc')->get();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'values' => ['required', 'array'],
            'values.*' => ['required', 'string', 'max:255'],

            'values.shipping_price' => ['required', 'numeric'],
            'values.start_time' => ['required', 'date_format:H:i'],
            'values.end_time' => ['required', 'date_format:H:i'],
            'values.send_order_submit_sms' => ['required', 'in:true,false'],
        ],
        [
            'values.send_order_submit_sms' => 'مقدار باید true یا false باشد',
            'values.shipping_price' => 'مقدار باید عددی باشد',
            'values.*' => 'مقدار ورودی صحیح نمی باشد!',
        ]);

        foreach ($request->values as $id => $value)
        {
            Setting::find($id)->update([
                'value' => $request->values[$id],
            ]);
        }

        return redirect()->back()->with('toast.success', 'تنظیمات با موفیت ذخیره شدند');
    }
}
