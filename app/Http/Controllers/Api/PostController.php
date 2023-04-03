<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Post::latest()->get());
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }
}
