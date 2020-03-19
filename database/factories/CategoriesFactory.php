<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'image' => 'media/categories/categoria_defecto.jpg',
        'name' => $faker->unique()->word,
        'discount' => $faker->randomDigit,
    ];
});
