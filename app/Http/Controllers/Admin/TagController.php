<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\EditTagRequest;
use App\Http\Requests\Admin\CreateTagRequest;

class TagController extends Controller
{
    public function index(): View
    {
        return view('admin.tags.index', ['tags' => Tag::paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(CreateTagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());

        return redirect()->route('admin.tags.index');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', ['tag' => $tag]);
    }

    public function update(EditTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());

        return redirect()->route('admin.tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        foreach ($tag->posts as $post) {
            $post->tags()->detach();
        }

        if (!$tag->posts()->count()) {
            $tag->delete();
        }

        return redirect()->route('admin.tags.index');
    }
}
