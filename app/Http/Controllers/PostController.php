<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::active()->published()->with(['postCategory', 'author'])->latest('published_at')->paginate(9);
        $categories = PostCategory::where('is_active', true)->withCount('posts')->orderBy('sort_order')->get();
        $featuredPosts = Post::active()->published()->featured()->with('postCategory')->latest('published_at')->take(3)->get();

        return view('posts.index', compact('posts', 'categories', 'featuredPosts'));
    }

    public function show(Post $post)
    {
        $post->increment('views');
        $post->load(['postCategory', 'author']);
        $relatedPosts = Post::active()->published()
            ->where('post_category_id', $post->post_category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')->take(3)->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
