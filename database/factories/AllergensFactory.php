<?php

use Faker\Generator as Faker;

$factory->define(App\Allergen::class, function (Faker $faker) {
    return [
        'image' => 'media/shared/imagen_defecto_2.png',
        'name' => $faker->unique()->word
    ];
});
