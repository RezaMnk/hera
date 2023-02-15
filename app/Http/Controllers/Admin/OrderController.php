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
