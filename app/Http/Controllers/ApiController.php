<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_map(Request $request)
    {
        session()->keep('discount');

        $request->validate([
            'id' => ['required', 'exists:maps']
        ]);

        $map = Map::find($request->id);

        if (auth()->user()->id == $map->user_id)
            return json_encode($map);

        else return false;
    }

    public function search_address(Request $request)
    {
        session()->keep('discount');

        $request->validate([
            'address' => ['required', 'string']
        ]);

        $lat_long = Map::search($request->address);

        return json_encode($lat_long);
    }

    public function cart_add(Product $product)
    {
        session()->keep('discount');

        if (cart()->exists($product) && ($quantity = cart()->get($product)['quantity']) < 100)
        {
            $quantity = cart()->get($product)['quantity'];
            cart()->update($product, $quantity + 1);
        }
        else
            return json_encode([
                'ok' => false,
                'quantity' => cart()->get($product)['quantity'],
            ]);

        return json_encode([
            'ok' => true,
            'quantity' => cart()->get($product)['quantity'],
        ]);
    }

    public function cart_remove(Product $product)
    {
        session()->keep('discount');

        if (cart()->exists($product) && ($quantity = cart()->get($product)['quantity']) > 1)
        {
            cart()->update($product, $quantity - 1);
        }
        else
            return json_encode([
                'ok' => false,
                'quantity' => cart()->get($product)['quantity'],
            ]);

        return json_encode([
            'ok' => true,
            'quantity' => cart()->get($product)['quantity'],
        ]);
    }

    public function get_product(Request $request)
    {
        session()->keep('discount');

        $request->validate([
            'slug' => ['required', 'exists:products']
        ]);

        $map = Product::firstWhere('slug', $request->slug);

        return json_encode($map);
    }
}
