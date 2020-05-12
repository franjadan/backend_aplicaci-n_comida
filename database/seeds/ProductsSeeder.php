<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Ingredient;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $categories = Category::all();
        $ingredients = Ingredient::all();

        foreach(range(1, 30) as $i) {
            $product = factory(App\Product::class)->create();
            $randomCategories = $categories->random(rand(1, 2));
            $randomIngredients = $ingredients->random(rand(1, 3));
            $product->categories()->attach($randomCategories);
            $product->ingredients()->attach($randomIngredients);
        }
    }
}
