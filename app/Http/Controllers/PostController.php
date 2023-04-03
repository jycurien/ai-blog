<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.index', ['posts' => $posts, 'title' => 'Posts']);
    }

    public function show(Post $post): View
    {
        return view('posts.show', ['post' => $post]);
    }
}
