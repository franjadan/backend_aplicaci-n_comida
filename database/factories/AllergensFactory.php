<?php

use Faker\Generator as Faker;

$factory->define(App\Allergen::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'name' => $faker->word
    ];
});
