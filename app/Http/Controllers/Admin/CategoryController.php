<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', ['categories' => Category::paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index');
    }

   public function edit(Category $category): View
   {
       return view('admin.categories.edit', ['category' => $category]);
   }

   public function update(EditCategoryRequest $request, Category $category): RedirectResponse
   {
       $category->update($request->validated());

       return redirect()->route('admin.categories.index');
   }

   public function destroy(Category $category): RedirectResponse
   {
       if ($category->posts()->count()) {
           return back()->withErrors(['error' => 'Cannot delete, category has posts.']);
       }

       $category->delete();

       return redirect()->route('admin.categories.index');
   }
}
