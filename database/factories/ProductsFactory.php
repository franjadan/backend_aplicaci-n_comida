<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'available' => true,
        'image' => 'media/shared/imagen_defecto.png',
        'min' => 'media/shared/min/imagen_defecto.png',
        'name' => $faker->unique()->word,
        'price' => $faker->randomDigit,
        'discount' => $faker->randomDigit,
    ];
});
