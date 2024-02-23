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
        $searchTerm = $request->input('search');

        $query = Post::latest();

        // Search functionality
        if ($searchTerm) {
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('body', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($category_id) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('categories.id', $category_id);
            });
        }

        // Pagination with 3 posts per page
        $posts = $query->paginate(3)->appends([
            'category' => $category_id,
            'search' => $searchTerm,
        ]);

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
