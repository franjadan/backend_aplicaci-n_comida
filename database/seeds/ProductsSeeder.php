<?php

use Illuminate\Database\Seeder;
use App\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $categories = Category::all();

        foreach(range(1, 30) as $i) {
            $product = factory(App\Product::class)->create();
            $randomCategories = $categories->random(rand(0, 2));
            $product->categories()->attach($randomCategories);
        }
    }
}
