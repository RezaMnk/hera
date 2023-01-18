<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'auth.admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statistics = (object) [
            'orders' => Order::statistics(now()->subWeek(), now()),
            'orders_not_read' => Order::statistics(false, now(), ['read' => 'false']),

            'users' => User::statistics(now()->subWeek(), now()),
            'products' => Product::statistics(now()->subWeek(), now()),
            'discounts' => Discount::statistics(now()->subWeek(), now()),
            'active_discounts' => Discount::statistics(now()->subWeek(), now(), ['expire_at' => now()]),
        ];
//        dd($statistics);
        return view('admin.index', compact('statistics'));
    }
}
