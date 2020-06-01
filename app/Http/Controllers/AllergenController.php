<?php

namespace App\Http\Controllers;

use App\Allergen;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAllergenRequest;
use App\Http\Requests\UpdateAllergenRequest;

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

    public function edit(Allergen $allergen)
    {
        return view('allergens.edit', [
            'allergen' => $allergen,
        ]);
    }

    public function update(UPdateAllergenRequest $request, Allergen $allergen)
    {
        $request->updateAllergen($allergen);

        return redirect()->route('allergens.edit', $allergen)->with('success', 'Se han guardado los cambios.');
    }

    public function destroy(Allergen $allergen)
    {
        $images = Allergen::where('image', '=', $allergen->image)->get();
        $image = public_path($allergen->image);
        if (@getimagesize($image) && count($images) <= 1) {
            unlink($image);
        }
        $allergen->delete();

        return redirect()->route('allergens')->with('success', 'Se ha eliminado conéxito');
    }
}
