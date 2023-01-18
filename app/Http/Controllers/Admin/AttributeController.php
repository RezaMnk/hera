<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the attributes.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $attributes = Attribute::where('parent_id', 0)->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new attribute.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.attributes.create');
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
        ]);

        // validate parent_id and must be different with id
//        TODO
        if ($request->parent_id != 0)
            $request->validate([
                'parent_id' => ['required', 'numeric', 'exists:attributes,id', 'different:id']
            ]);

        Attribute::create($request->all());

        alert('عملیات موفقیت آمیز بود','دسته بندی با موفقیت به لیست اضافه شد', 'success');
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Attribute $attribute
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Attribute $attribute)
    {
        $attributes = Attribute::where('parent_id', 0)->get();
        return view('admin.attributes.index', compact('attribute', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($request->parent_id)
            $request->validate([
                'parent_id' => ['required', 'numeric', 'exists:attributes,id', 'different:id']
            ]);

        $attribute->update($request->all());

        alert('عملیات موفقیت آمیز بود','دسته بندی با موفقیت ویرایش شد', 'success');
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attribute $attribute)
    {

        $products = Product::whereHas('attributes', function ($query) use ($attribute) {
            $query->where('id', $attribute->id);
            if (! $attribute->parent_id)
                $query->orWhereIn('id', $attribute->children->pluck('id')->toArray());
        });

        foreach ($products->get() as $product)
        {
            $product->status = 0;
            $product->attributes()->detach($attribute->id);

            foreach ($attribute->children()->get() as $attribute_child)
                $product->attributes()->detach($attribute_child->id);

            $product->touch();
        }

        $attribute->delete();

        alert('عملیات موفقیت آمیز بود','دسته بندی با موفقیت حذف شد', 'success');
        return back();
    }
}
