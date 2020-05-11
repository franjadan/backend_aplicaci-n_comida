<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::search()
            ->orderBy('name')
            ->paginate(5);

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

        return redirect()->route('categories')->with('success', 'Se ha creado la categoría con éxito.');
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

        return redirect()->route('categories.edit', $category)->with('success', 'Se han guardado los cambios.');
    }

    public function destroy(Category $category)
    {
        $images = Category::where('image', '=', $category->image)->get();
        $image = public_path($category->image);
        if (@getimagesize($image) && count($images) <= 1){
            unlink($image);
            $image = public_path($category->min);
            unlink($image);

        }
        $category->delete();

        return redirect()->route('categories')->with('success', 'Se ha eliminado con éxito.');
    }

    public function categories()
    {
        $categories = Category::all();

        return response()->json(['response' => ['code' => 1, 'data' => CategoryResource::collection($categories)]], 200);
    }
}
