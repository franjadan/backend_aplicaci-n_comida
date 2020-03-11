<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
        ->orderBy('name')
        ->paginate();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $category = new Category;

        return view('categories.create', [
            'category' => $category,
        ]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $request->createCategory();

        return redirect()->route('categories');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->updateCategory($category);

        return redirect()->route('categories.edit', $category);
    }

    public function destroy(Category $category)
    {
        $image = public_path()."/$category->image";
        if (@getimagesize($image)){
            unlink($image);
        }
        $category->delete();

        return redirect()->route('categories');
    }
}
