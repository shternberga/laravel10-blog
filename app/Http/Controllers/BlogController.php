<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->get('category');

        $query = Post::latest();

        if ($category_id) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('categories.id', $category_id);
            });
        }

        $posts = $query->paginate(3)->appends($request->query());

        return view('pages.blog.index', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function show($id)
    {
        $post = Post::with('categories', 'comments')->findOrFail($id);
        $categories = Category::all();
        return view('pages.blog.show', compact('post', 'categories'));
    }
}
