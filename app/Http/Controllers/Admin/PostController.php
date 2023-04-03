<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Contract\AiTextApi;
use App\Contract\AiImageApi;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\EditPostRequest;
use App\Http\Requests\Admin\CreatePostRequest;

class PostController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index', ['posts' => Post::latest()->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    
    public function store(AiImageApi $imageApi, AiTextApi $textApi, CreatePostRequest $request): RedirectResponse
    {
        try {
            $imgUrl = $imageApi->getImageContentUrl($request->title, '512x512');
            $content = $textApi->getPostContent($request->title, 300);
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => sprintf('Could not create post: %s', $exception->getMessage())
            ]);
        }

        $filename = uniqid() . '_' . time() . '.png';
        Storage::disk('public')->put('uploads/' . $filename, file_get_contents($imgUrl));

        
        $post = Post::create([
            'title' => $request->title,
            'image' => 'storage/uploads/' . $filename,
            'content' => $content,
        ]);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(EditPostRequest $request, Post $post): RedirectResponse
    {
        if ($request->has('image')) {
            Storage::delete('public/uploads/' . $post->image);
            
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }

        $post->update([
            'title' => $request->title,
            'image' => $filename ?? false ? 'storage/uploads/' . $filename : $post->image,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->image) {
            Storage::delete(str_replace('storage', 'public', $post->image));
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}