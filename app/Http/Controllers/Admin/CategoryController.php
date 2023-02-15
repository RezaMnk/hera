<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::query();

        if ($keyword = request('search')) {
            $categories->where('name', 'LIKE', "%$keyword%");
        }

        $categories = $categories->latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'image' => ['required', 'image', 'max:128'],
        ]);

        $image = $request->file('image');
        $file_name = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();

        Storage::disk('categories')->putFileAs('', $image, $file_name);

        Category::create([
            'name' => $request->name,
            'image' => $file_name,
        ]);

        return redirect()->route('admin.categories.index')->with('toast.success', 'دسته بندی با موفیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Category $category)
    {
        if ($category->id == 1)
            return redirect()->route('admin.categories.index');

        $categories = Category::query()->latest()->paginate(20);
        return view('admin.categories.index', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:128'],
        ]);

        if ($category->id == 1)
            return redirect()->route('admin.categories.index');

        $file_name = $category->image;

        if ($request->hasFile('image')) {
            Storage::disk('categories')->delete($category->image);

            $image = $request->file('image');
            $file_name = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();

            Storage::disk('categories')->putFileAs('', $image, $file_name);
        }

        $category->update([
            'name' => $request->name,
            'image' => $file_name,
        ]);

        return redirect()->route('admin.categories.index')->with('toast.success', 'دسته بندی با موفیت ویرایش شد');
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
            'id' => ['required', 'exists:categories']
        ]);

        if ($request->id == 1)
            return back();

        $category = Category::find($request->id);

        $products = Product::where('category', $category->id)->get();

        foreach ($products as $product)
        {
            $product->category = 1;
            $product->touch();
        }

        $category->delete();

        return redirect()->back()->with('toast.success', 'دسته بندی با موفیت حذف شد');
    }
}
