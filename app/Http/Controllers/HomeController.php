<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
    }

    /**
     * Show the menu page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function menu(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string']
        ]);
        $products = Product::query();

        if ($request->has('search'))
            $products->where('name', $request->search);

        $products = $products->latest()->paginate(30);
        $categories = Category::query()->whereNot('id', '1')->get();
        return view('home.menu', compact('products', 'categories'));
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product(Product $product)
    {
        $related_products = Product::all();
        return view('home.product', compact('product', 'related_products'));
    }

    /**
     * Show the cart page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cart()
    {
        return view('home.cart');
    }

    /**
     * Show the checkout page.
     *
     * @return Renderable
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkout()
    {
        if (session()->has('discount'))
        {
            session()->reflash();
            $discount = session()->get('discount');
            return view('home.checkout', compact('discount'));
        }

        return view('home.checkout');
    }

    /**
     * Show the cart page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = auth()->user();
        $orders = $user->orders()->take(5)->get();
        return view('home.profile', compact('user', 'orders'));
    }
}
