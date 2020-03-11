<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'comments',
            'users',
            'ingredients',
            'allergens',
            'categories',
            'products',
            'orders',
        ]);

        $this->call([
            UsersSeeder::class,
            CommentsSeeder::class,
            AllergensSeeder::class,
            IngredientsSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrdersSeeder::class,
        ]);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
