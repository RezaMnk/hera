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

        $orders = $this->search_filter($orders)->whereStatus('success')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }
    /**
     * Display a listing of the failed orders.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function failed()
    {
        $orders = Order::query();

        $orders = $this->search_filter($orders)->whereStatus('failed')->latest()->paginate(20);
        return view('admin.orders.failed', compact('orders'));
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
            $orders->Where('id', 'LIKE', "%$keyword%")
                ->orWhereHas('user', function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        }

        return $orders;
    }
}
