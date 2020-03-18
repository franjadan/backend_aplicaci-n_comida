<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
{
    public function index() 
    {
        $ingredients = Ingredient::query()
            ->orderBy('name')
            ->paginate();

        return view('ingredients.index', [
            'ingredients' => $ingredients
        ]);
    }

    public function create()
    {
        $ingredient = new Ingredient;

        return view('ingredients.create', [
            'ingredient' => $ingredient,
        ]);
    }

    public function store(CreateIngredientRequest $request)
    {
        $request->createIngredient();

        return redirect()->route('ingredients.store');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', [
            'ingredient' => $ingredients,
        ]);
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $request->updateIngredient($ingredient);

        return redirect()->route('ingredients.edit', $ingredient);
    }

    public function destroy(Ingredient $Ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.destroy');
    }
}