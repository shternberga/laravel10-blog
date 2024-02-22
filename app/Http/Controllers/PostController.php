<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        $categories = Category::all();
        return view('pages.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        return view('pages.posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'media' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'categories' => 'nullable|string',
        ]);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('public/media');
            $validatedData['media'] = $path;
        }

        $post = Post::create($validatedData + ['user_id' => auth()->id()]);

        if ($request->has('categories')) {
            $categoryIds = explode(',', $request->categories);
            $post->categories()->sync($categoryIds);
        }

        session()->flash('success', 'Post created successfully.');

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return view('pages.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        return view('pages.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'media' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'categories' => 'nullable|string',
        ]);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('public/media');
            $validatedData['media'] = $path;
        }
        if ($request->has('categories')) {
            $categoryIds = explode(',', $request->categories);
            $post->categories()->sync($categoryIds);
        }
        $post->update($validatedData);

        session()->flash('success', 'Post updated successfully.');

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        session()->flash('success', 'Post deleted successfully.');

        return redirect()->route('posts.index');
    }
}
