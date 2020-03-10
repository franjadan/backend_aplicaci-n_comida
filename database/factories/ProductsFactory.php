<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'available' => true,
        'image' => "media/shared/lorem_ipsum.jpg",
        'name' => $faker->word,
        'price' => $faker->randomDigit,
        'discount' => $faker->randomDigit,
    ];
});
