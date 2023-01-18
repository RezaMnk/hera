<?php

namespace App\Helpers\Cart;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartService extends Facade
{
    protected $cart;

    function __construct()
    {
        $this->cart = session()->get('cart')  ?? collect([]);
    }

    /**
     * put product data to cart session
     *
     * @param Product $product
     * @param int $quantity
     * @return $this
     */
    public function put(Product $product, int $quantity)
    {
        $value = [
            'id' => Str::random(10),
            'product' => $product->id,
            'quantity' => $quantity,
        ];

        $this->cart->put($value['id'], $value);
        session()->put('cart', $this->cart);

        return $this;
    }

    /**
     * update product data in cart session
     *
     * @param Product $product
     * @param int $quantity
     * @return bool
     */
    public function update(Product $product, int $quantity = 0)
    {
        $this->cart = $this->cart->map(function ($item) use ($quantity, $product) {
            if($item['product'] == $product->id)
                $item['quantity'] = $quantity;
            return $item;
        });

        session()->put('cart', $this->cart);

        return true;
    }


    /**
     * check if product is added to cart already
     *
     * @param Product $product
     * @return bool
     */
    public function has(Product $product)
    {
        return ! is_null($this->cart->firstWhere('product', $product->id));
    }


    /**
     * get specific product in cart
     *
     * @param Product $product
     * @param array|bool $variables
     * @return mixed|null
     */
    public function get(Product $product)
    {
        $result = $this->cart->where('product', $product->id);

        return $result->count() > 0 ? $this->make($result->first()) : false;
    }


    /**
     * get specific product in cart
     *
     * @param $id
     * @return mixed|null
     */
    public function find($id)
    {
        $result = $this->cart->where('id', $id)->first();

        return $result ?? false;
    }


    /**
     * get specific product in cart
     *
     * @param Product $product
     * @return bool
     */
    public function exists(Product $product)
    {
        $result = $this->cart->where('product', $product->id);

        return $result->count() > 0;
    }


    /**
     * remove product from cart
     *
     * @param Product $product
     * @return bool
     */
    public function remove(Product $product)
    {
        $item = $this->get($product)->toArray();
        $this->cart->forget($item['id']);

        session()->put('cart', $this->cart);

        return true;
    }


    /**
     * get all the products in cart
     *
     * @return mixed|null
     */
    public function all()
    {
        return $this->make($this->cart->all());
    }


    /**
     * replace product id with its collection
     *
     * @param $item
     * @return mixed
     */
    private function make($item)
    {
        if (isset($item['id'])) {
            $item['product'] = Product::find($item['product']);
            if (is_null($item['product']))
            {
                $this->cart->forget($item['id']);
                session()->put('cart', $this->cart);

                return false;
            }

            return collect($item);
        }

        foreach ($item as $k => $value)
        {
            if ($made = $this->make($value))
                $item[$k] = $made;
        }

        return collect($item);
    }


    public function clear()
    {
        session()->forget('cart');
    }
}
