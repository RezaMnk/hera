<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::query();

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the unapproved orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function unapproved()
    {
        $orders = Order::query()->where('status', 'unapproved');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the priced orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function priced()
    {
        $orders = Order::query()->where('status', 'priced');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the paid orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function paid()
    {
        $orders = Order::query()->where('status', 'paid');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the approved orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function approved()
    {
        $orders = Order::query()->where('status', 'approved');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the completed orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function completed()
    {
        $orders = Order::query()->where('status', 'completed');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the completed orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function delivered()
    {
        $orders = Order::query()->where('status', 'delivered');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display a listing of the canceled orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function canceled()
    {
        $orders = Order::query()->where('status', 'canceled');

        $orders = $this->search_filter($orders)->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->cancel();

        alert('عملیات موفقیت آمیز بود','سفارش با موفقیت لغو شد', 'success');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
//        $data = $request->validate([
//            'quantity' => ['required', 'array'],
//            'quantity.*' => ['required', 'numeric', 'min:1'],
////            TODO: Version Change -> No Api
////            'price' => ['required', 'array'],
////            'price.*' => ['required', 'numeric'],
//        ]);

//        TODO: Version Change -> No Api
//        if (array_keys($data['quantity'] ) !== array_keys($data['price']))
//            return redirect()->back()->withErrors(['ids' => 'مقادیر وارد شده معتبر نمی باشد. صفحه را رفرش کنید.']);

//        $sync = [];
//        foreach($data['quantity'] as $product_id => $quantity)
//            $sync[$product_id] = [
//                'quantity' => $quantity,
////                TODO: Version Change -> No Api
////                'price' => $data['price'][$product_id],
//            ];

//        $order->products()->sync($sync);
        $order->approve();

        $order->user->send_sms([$order->id], 'order-priced');

        alert('عملیات موفقیت آمیز بود','سفارش با موفقیت ویرایش شد', 'success');
        return redirect()->route('admin.orders.index');
    }


    public function approve(Request $request)
    {
        $request->validate([
            'order' => ['required', 'numeric', 'exists:orders,id']
        ]);

        $order = Order::find($request->order);

//        if ($order->status == 'paid')
            $order->approve();

        $order->user->send_sms([$order->id], 'order-approved');

        alert()->success('عملیات موفقیت آمیز بود', 'سفارش با موفقیت تایید شد');
        return redirect()->route('admin.orders.index');
    }


    public function deliver(Request $request)
    {
        $request->validate([
            'order' => ['required', 'numeric', 'exists:orders,id']
        ]);

        $order = Order::find($request->order);

        if ($order->status == 'approved')
            $order->deliver();

        $order->user->send_sms([$order->id], 'order-delivered');

        alert()->success('عملیات موفقیت آمیز بود', 'سفارش با موفقیت تحویل داده شد');
        return redirect()->route('admin.orders.index');
    }



    public function cancel(Request $request)
    {
        $request->validate([
            'order' => ['required', 'numeric', 'exists:orders,id']
        ]);

        $order = Order::find($request->order);
        $order->cancel();

        alert('عملیات موفقیت آمیز بود','سفارش با موفقیت لغو شد', 'success');
        return redirect()->back();
    }

    /**
     * filter with search param
     *
     * @param $orders
     * @return mixed
     */
    public function search_filter($orders)
    {
        if ($keyword = request('search')) {
            $orders->whereHas('user', function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
                ->orWhere('id', 'LIKE', "%$keyword%");
        }

        return $orders;
    }
}
