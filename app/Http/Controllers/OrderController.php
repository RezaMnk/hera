<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        session()->keep('discount');

        $request->validate([
            'address' => ['required', 'numeric', 'exists:maps,id'],
            'discount' => ['nullable', 'string', 'exists:discounts,name'],
        ]);

        $discount = null;
        $discount_value = null;
        if (! is_null($request->discount))
        {
            $discount = Discount::firstWhere('name', $request->discount);

            if ($discount->expire_at <= now())
                return redirect()->route('home.cart')->with('toast.danger', 'کد تخفیف منقضی شده است');
        }

        $sync = [];
        $total = 0;
        foreach (cart()->all() as $cart_item)
        {
            $sync[$cart_item['product']->id] = ['quantity' => $cart_item['quantity']];
            $total += $cart_item['product']->price * $cart_item['quantity'];
        }

        if ($discount)
            if ($discount->type == 'static')
                $discount_value = min([$discount->value, $total]);
            elseif ($discount->type == 'percent')
                $discount_value = $total - ($total * ($discount->value/100));


        $create = [
            'map_id' => $request->address,
            'total_price' => $total - $discount_value,
        ];

        if ($discount)
        {
            $create['discount_id'] = $discount->id;
            $create['discount_value'] = $discount_value;
        }


        $order = auth()->user()->orders()->create($create);

        $order->products()->sync($sync);

        cart()->clear();
        session()->forget('discount');

        return redirect()->route('order.invoice', $order->id)->with('toast.success', 'سفارش با موفقیت ثبت شد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'discount' => ['nullable', 'string', 'exists:discounts,name'],
        ], [
            'discount.exists' => 'کد تخفیف معتبر نمی باشد'
        ]);

        if (! is_null($request->discount))
        {
            $discount = Discount::firstWhere('name', $request->discount);

            if ($discount->expire_at <= now())
                return redirect()->route('home.cart')->with('toast.danger', 'کد تخفیف منقضی شده است');

            $is_used = auth()->user()->orders()->whereHas('discount', function ($query) use ($discount) {
                $query->where('id', $discount->id);
            })->count() > 0;
            if ($is_used)
                return redirect()->route('home.cart')->with('toast.danger', 'کد تخفیف قبلا استفاده شده است');

            session()->flash('discount', $discount);
            return redirect()->route('home.checkout')->with('toast.success', 'کد تخفیف با موفقیت اعمال شد');
        }
        else
            return redirect()->route('home.checkout');
    }

    public function invoice(Order $order)
    {
        if (
            ($order->user_id != auth()->user()->id)
            && !(auth()->user()->is_admin())
        )
            abort(404);

        if (auth()->user()->is_admin())
            $order->read();

        return view('home.invoice', compact('order'));
    }
}
