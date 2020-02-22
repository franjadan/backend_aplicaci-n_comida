<?php

use Illuminate\Database\Seeder;

class AllergensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Allergen::class)->times(15)->create();
    }
}
