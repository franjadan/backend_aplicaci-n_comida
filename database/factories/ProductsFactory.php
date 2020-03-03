<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'available' => true,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'name' => $faker->word,
        'price' => $faker->randomDigit,
        'discount' => $faker->randomDigit,
    ];
});
