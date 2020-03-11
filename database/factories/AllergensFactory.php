<?php

use Faker\Generator as Faker;

$factory->define(App\Allergen::class, function (Faker $faker) {
    return [
        'image' => "media/shared/lorem_ipsum.jpg",
        'name' => $faker->word
    ];
});
