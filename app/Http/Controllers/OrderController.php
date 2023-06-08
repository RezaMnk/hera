<?php

namespace App\Http\Controllers;


use App\Events\NewOrder;
use App\Models\Discount;
use App\Models\Order;
use Evryn\LaravelToman\CallbackRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Evryn\LaravelToman\Facades\Toman;

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

        if (cart()->all()->count() == 0)
            return redirect()->route('home.cart')->with('toast.danger', 'کد تخفیف منقضی شده است');

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

        $total += $total * 9/100;

        $total += setting('shipping_price');

        if ($discount)
            if ($discount->type == 'static')
                $discount_value = min([$discount->value, $total]);
            elseif ($discount->type == 'percent')
                $discount_value = $total * ($discount->value/100);


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

        return $this->request_to_pay($order);

//        cart()->clear();
//        session()->forget('discount');
//
//        event(new NewOrder($order));
//
//        if (setting('send_order_submit_sms') == 'true')
//            auth()->user()->send_sms([$order->id], setting('sms_order_submit'));
//
//        return redirect()->route('order.invoice', $order->id)->with('toast.success', 'سفارش با موفقیت ثبت شد');
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
            })->where('status', 'success')->count() > 0;
            if ($is_used)
                return redirect()->route('home.cart')->with('toast.danger', 'کد تخفیف قبلا استفاده شده است');

            session()->flash('discount', $discount);
            return redirect()->route('home.checkout')->with('toast.success', 'کد تخفیف با موفقیت اعمال شد');
        }
        else
            return redirect()->route('home.checkout');
    }


    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reorder(Order $order)
    {
        cart()->clear();

        foreach ($order->products as $product)
        {
            cart()->put($product, $product->pivot->quantity);
        }

        return redirect()->route('home.checkout');
    }


    public function invoice(Order $order)
    {
        if (
            (
                ($order->user_id != auth()->user()->id)
                && !(auth()->user()->is_admin())
            ) || $order->status !== 'success'
        )
            abort(404);

        if (auth()->user()->is_admin())
            $order->read();

        return view('home.invoice', compact('order'));
    }

    public function verify_payment(Request $request,Order $order)
    {
        if ($request->Status == 'OK')
            $payment = Toman::transactionId($order->transaction_id)
                ->amount($order->total_price)
                ->verify();

        else {
            $order->status = 'failed';
            $order->touch();

            return redirect()->route('home.profile', $order->id)->with('toast.danger', 'خطا در انجام تراکنش! سفارش شما پرداخت نشد.');
        }

        if ($payment->successful() || $payment->alreadyVerified()) {
            $referenceId = $payment->referenceId();
            $order->reference_id = $referenceId;
            $order->status = 'success';
            $order->touch();

            cart()->clear();
            session()->forget('discount');

            event(new NewOrder($order));

            if (setting('send_order_submit_sms') == 'true')
                auth()->user()->send_sms([$order->id], setting('sms_order_submit'));

            return redirect()->route('order.invoice', $order->id)->with('toast.success', 'سفارش با موفقیت ثبت شد');
        }

        if ($payment->failed()) {
            $referenceId = $payment->referenceId();
            $order->reference_id = $referenceId;
            $order->status = 'failed';
            $order->touch();

            return redirect()->route('home.profile', $order->id)->with('toast.danger', 'خطا در انجام تراکنش! سفارش شما پرداخت نشد.');
        }
    }


    private function request_to_pay(Order $order)
    {
        $request = Toman::amount($order->total_price)
             ->callback(route('order.verify_payment', $order->id))
             ->mobile($order->user->phone)
            ->request();

        if ($request->successful()) {
            $transactionId = $request->transactionId();

            $order->transaction_id = $transactionId;
            $order->touch();

            return $request->pay();
        }

        if ($request->failed()) {
            dd('faild');
        }
    }
}
