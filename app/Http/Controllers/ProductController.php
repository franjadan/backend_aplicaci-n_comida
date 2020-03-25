<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();

        if ($request->ajax()) {
            return Datatables::of($products)
                ->addColumn('discount', function($row) {
                    if($row->discount == 0){
                        return "<td>Sin descuento</td>";
                    }else{
                        return "<td>". $row->discount ."</td>";
                    }
                })
                ->addColumn('actions', function($row){
                        $actions = "<form action='". route('products.destroy', $row) . "' method='POST'>" .csrf_field() . "" . method_field('DELETE') . "<a class='btn btn-primary mr-1' href='" . route('products.edit', ['product' => $row]) . "'><i class='fas fa-edit'></i></a><button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button></form>";
                        return $actions;
                })
                ->rawColumns(['discount', 'actions'])
                ->make(true);
        }

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

    public function destroy(Product $product)
    {
        $image = public_path()."/$product->image";
        if (@getimagesize($image)){
            unlink($image);
        }
        $product->delete();

        return redirect()->route('products')->with('success', 'Se ha eliminado con éxito');
    }
}
