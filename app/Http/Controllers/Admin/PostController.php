<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::query();

        if ($keyword = request('search')) {
            $posts->where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%");
        }

        $posts = $posts->latest()->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
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
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required'],
            'image' => ['required', 'image', 'max:256'],
        ]);

        $image = $request->file('image');
        $file_name = $request->title . '-' . time() . '.' . $image->getClientOriginalExtension();

        Storage::disk('posts')->putFileAs('', $image, $file_name);

        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'image' => $file_name,
        ]);

        return redirect()->route('admin.posts.edit', $post->id)->with('toast.success', 'مقاله با موفیت منتشر شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required'],
            'image' => ['nullable', 'image', 'max:256'],
        ]);

        $file_name = $post->image;

        if ($request->hasFile('image')) {
            Storage::disk('posts')->delete($post->image);

            $image = $request->file('image');
            $file_name = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();

            Storage::disk('posts')->putFileAs('', $image, $file_name);
        }

        $post->update([
            'title' => $request->title,
            'text' => $request->text,
            'image' => $file_name,
        ]);

        return redirect()->back()->with('toast.success', 'مقاله با موفیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:posts']
        ]);

        $post = Post::find($request->id);

        $post->delete();

        return redirect()->back()->with('toast.success', 'مقاله با موفیت حذف شد');
    }
}
