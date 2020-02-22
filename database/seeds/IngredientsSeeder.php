<?php

use Illuminate\Database\Seeder;
use App\Allergen;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allergens = Allergen::all();
    
        foreach(range(1, 30) as $i) {
            $ingredient = factory(\App\Ingredient::class)->create();
            $randomAllegens = $allergens->random(rand(0, 2));
            $ingredient->allergens()->attach($randomAllegens);
        }
    }
}
