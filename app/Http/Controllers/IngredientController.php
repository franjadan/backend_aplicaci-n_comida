<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\Allergen;
use App\Http\Requests\CreateIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;

class IngredientController extends Controller
{
    public function index() 
    {
        $ingredients = Ingredient::query()
            ->orderBy('name')
            ->get();

        return view('ingredients.index', [
            'ingredients' => $ingredients
        ]);
    }

    public function create()
    {
        $ingredient = new Ingredient;
        $allergens = Allergen::query()->orderby('name')->get();
        return view('ingredients.create', [
            'ingredient' => $ingredient,
            'allergens' => $allergens,
        ]);
    }

    public function store(CreateIngredientRequest $request)
    {
        $request->createIngredient();

        return redirect()->route('ingredients.index')->with('success', 'Se ha creado el ingrediente con éxito.');
    }

    public function edit(Ingredient $ingredient)
    {
        $allergens = Allergen::query()->orderby('name')->get();

        return view('ingredients.edit', [
            'ingredient' => $ingredient,
            'allergens' => $allergens,
        ]);
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $request->updateIngredient($ingredient);
        
        return redirect()->route('ingredients.index', $ingredient)->with('success', 'Se ha modificado el ingrediente con éxito.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Se ha eliminado el ingrediente.');
    }
}