<?php

use Illuminate\Database\Seeder;
use App\Product;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        foreach(range(1, 10) as $i) {
            $order = factory(App\Order::class)->create();
            $randomProduct = $products->random(rand(1,5));
            $order->products()->attach($randomProduct);
        }

        
    }
}