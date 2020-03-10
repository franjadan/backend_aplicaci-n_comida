<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'image' => "media/shared/lorem_ipsum.jpg",
        'name' => $faker->word,
        'discount' => $faker->randomDigit,
    ];
});
