<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;

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
}
