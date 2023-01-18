<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::query();

        if ($keyword = request('search')) {
            $products->where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%");
        }

        $products = $products->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::whereNot('id', '1')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'numeric', 'exists:categories,id'],
            'image' => ['required', 'image', 'max:256'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $image = $request->file('image');
        $file_name = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();

        Storage::disk('products')->putFileAs('', $image, $file_name);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $file_name,
        ]);


        return redirect()->route('admin.products.index')->with('toast.success', 'محصول با موفیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::whereNot('id', '1')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'numeric', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:256'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $file_name = $product->image;

        if ($request->hasFile('image')) {
            Storage::disk('products')->delete($product->image);

            $image = $request->file('image');
            $file_name = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();

            Storage::disk('products')->putFileAs('', $image, $file_name);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $file_name,
        ]);

        return redirect()->back()->with('toast.success', 'محصول با موفیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:products']
        ]);

        $product = Product::find($request->id);

        $product->delete();

        return redirect()->back()->with('toast.success', 'محصول با موفیت حذف شد');
    }
}
