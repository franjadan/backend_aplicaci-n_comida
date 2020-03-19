<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
        ->orderby('name')
        ->paginate();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $product = new Product();
        $categories = Category::query()->orderby('name')->get();
        $ingredints = Ingredient::query()->orderby('name')->get();

        return view('products.create', [
            'product' => $product,
            'categories' => $categories,
            'ingredients' => $ingredints,
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $request->createProduct();

        return redirect()->route('products')->with('success', 'Se ha creado el producto con éxito.');
    }

    public function edit(Product $product)
    {
        $categories = Category::query()->orderby('name')->get();
        $ingredints = Ingredient::query()->orderby('name')->get();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'ingredients' => $ingredints,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->updateProduct($product);

        return redirect()->route('products.edit', $product)->with('success', 'Se han guardado los cambios.');
    }
}
