<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * add product to cart
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        $quantity = $request->has('quantity') ? $request->quantity : 1;

        if ($product->price <= 0)
            redirect()->back()->with('toast.danger', 'این محصول را نمی توان سفارش داد');

        if (cart()->exists($product))
        {
            $now_quantity = cart()->get($product)['quantity'];
            cart()->update($product, $now_quantity + $quantity);
        }
        else
            cart()->put($product, $quantity);


        return redirect()->back()->with('toast.success', 'محصول با موفقیت به سبد خرید افزوده شد');
    }


    /**
     * remove product from cart
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function remove(Product $product)
    {
        cart()->remove($product);

        return redirect()->back()->with('toast.success', 'محصول با موفقیت از سبد خرید حذف شد');
    }


    /**
     * clear all products from cart
     *
     * @return RedirectResponse
     */
    public function clear()
    {
        cart()->clear();

        return redirect()->back()->with('toast.success', 'سبد خرید با موفقیت حذف شد');
    }
}
