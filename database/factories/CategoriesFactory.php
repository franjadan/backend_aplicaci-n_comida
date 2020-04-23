<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'image' => 'media/shared/imagen_defecto.png',
        'name' => $faker->unique()->word,
    ];
});
