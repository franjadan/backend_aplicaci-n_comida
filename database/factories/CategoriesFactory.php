<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'image' => "media/categories/categoria_defecto",
        'name' => $faker->word,
        'discount' => $faker->randomDigit,
    ];
});
