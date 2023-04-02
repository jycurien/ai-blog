<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
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
        return view('admin.posts.index', ['posts' => Post::with('category')->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.posts.create', ['categories' => Category::all()]);
    }

    
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $tags = explode(',', $request->tags);

        if ($request->has('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }
        
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'image' => $filename ?? false ? 'storage/uploads/' . $filename : null,
            'content' => $request->content,
            'category_id' => $request->category
        ]);

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        }

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => $post->tags->implode('name', ', '),
            'categories' => Category::all()
        ]);
    }

    public function update(EditPostRequest $request, Post $post): RedirectResponse
    {
        $tags = explode(',', $request->tags);

        if ($request->has('image')) {
            Storage::delete('public/uploads/' . $post->image);
            
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }

        $post->update([
            'title' => $request->title,
            'image' => $filename ?? false ? 'storage/uploads/' . $filename : $post->image,
            'content' => $request->content,
            'category_id' => $request->category
        ]);

        $newTags = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            array_push($newTags, $tag->id);
        }
        $post->tags()->sync($newTags);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->image) {
            Storage::delete(str_replace('storage', 'public', $post->image));
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}