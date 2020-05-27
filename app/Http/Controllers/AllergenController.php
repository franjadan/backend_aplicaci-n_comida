<?php

namespace App\Http\Controllers;

use App\Allergen;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAllergenRequest;

class AllergenController extends Controller
{
    public function index()
    {
        $allergens = Allergen::query()
        ->orderBy('created_at')
        ->get();

        return view('allergens.index', [
            'allergens' => $allergens,
        ]);
    }

    public function create()
    {
        $allergen = new Allergen;

        return view('allergens.create', [
            'allergen' => $allergen,
        ]);
    }

    public function store(CreateAllergenRequest $request)
    {
        $request->createAllergen();

        return redirect()->route('allergens')->with('success', 'Se ha creado el alérgeno con éxito.');
    }
}
