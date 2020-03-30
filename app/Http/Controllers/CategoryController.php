<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            return Datatables::of($categories)
                ->addColumn('discount', function($row) {
                    if($row->discount == 0){
                        return "<td>Sin descuento</td>";
                    }else{
                        return "<td>". $row->discount ."</td>";
                    }
                })
                ->addColumn('actions', function($row){
                        $actions = "<form action='". route('categories.destroy', $row) . "' method='POST'>" .csrf_field() . "" . method_field('DELETE') . "<a class='btn btn-primary mr-1' href='" . route('categories.edit', ['category' => $row]) . "'><i class='fas fa-edit'></i></a><button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button></form>";
                        return $actions;
                })
                ->rawColumns(['discount', 'actions'])
                ->make(true);
        }

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

        return redirect()->route('categories.edit', $category)->with('sucsess', 'Se han guardado los cambios.');
    }

    public function destroy(Category $category)
    {
        $image = public_path()."/$category->image";
        if (@getimagesize($image)){
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
