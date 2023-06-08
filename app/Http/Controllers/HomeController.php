<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
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
            $products->where('name', 'LIKE', '%'. $request->search .'%');

        $products = $products->get();
        $categories = Category::query()->whereNot('id', '1')->get();
        return view('home.menu', compact('products', 'categories'));
    }

    /**
     * Show the product page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product(Product $product)
    {
        $related_products = Product::all()->where('category_id', $product->category_id)->where('id', '<>', $product->id);
        return view('home.product', compact('product', 'related_products'));
    }

    /**
     * Show the menu page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function posts()
    {
        $posts = Post::query();

        $posts = $posts->latest()->paginate(30);
        return view('home.posts', compact('posts'));
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function post(Post $post)
    {
        $recent_posts = Post::query()->whereNot('id', $post->id)->latest()->take(5)->get();
        return view('home.post', compact('post', 'recent_posts'));
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
     * @return Renderable|\Illuminate\Http\RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkout()
    {
        if (! is_active_hours())
            return redirect()->route('home.cart')->with('toast.warning', 'ساعت کاری به پایان رسیده است');

        if (cart()->all()->count() < 1)
            return redirect()->route('home.cart')->with('toast.warning', 'سبد خرید شما خالی می باشد');

        if (session()->has('discount'))
        {
            session()->reflash();
            $discount = session()->get('discount');
            return view('home.checkout', compact('discount'));
        }

        return view('home.checkout');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = auth()->user();
        $orders = $user->orders()->whereNot('status', 'to-pay')->take(5)->latest()->get();
        return view('home.profile', compact('user', 'orders'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('home.about');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('home.contact');
    }

    /**
     * Show the company page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function company()
    {
        return view('home.company');
    }
}
